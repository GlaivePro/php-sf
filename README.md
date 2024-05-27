# PHP Simple Features SQL

Build SFA-SQL (SQL/MM) expressions using SFA-CA syntax.

> **Note**
> Currently this doc contains not only description of this package and
> documentation sketch, but plans and research as well. WIP. Unreleased.

[Simple Features](https://en.wikipedia.org/wiki/Simple_Features) is a standard
(multiple standards actually) by Open Geospatial Consortium defining models for
geospatial data. The standard defines object oriented and SQL access (known as
SFA-SQL, SQL/MM and ArcSDE among others) to these models. This package
implements the object oriented SFA API in PHP and produces SFA-SQL expressions
from it.

It can be used to build SQL statements for systems such as PostGIS,
SpatiaLite, MySQL spatial and others implementing SFA-SQL or SQL-MM.

## Feature examples

The objects in this lib allow chaining SFA to create SQL expressions:

```php
$geometry = new Geometry('ST_MakePoint(?, ?)', [3, 5]);
$another = new Geometry("'LINESTRING ( 2 0, 0 2 )'::geometry");

$envelope = $geometry->envelope();

(string) $envelope; // ST_Envelope(ST_MakePoint(?, ?))
$envelope->bindings; // [3, 5]

$expression = $geometry
	->union($another)
	->buffer($geometry->distance($another))
	->buffer(5.2)
	->convexHull();

(string) $expression; // ST_ConvexHull(ST_Buffer(ST_Buffer(ST_Union(ST_MakePoint(?, ?), 'LINESTRING ( 2 0, 0 2 )'::geometry), ST_Distance(ST_MakePoint(?, ?), ST_MakePoint(1, 1))), ?))
$expression->bindings; // [3, 5, 3, 5, 5.2]
```

You can also specify columns:

```php
$geom = new Geometry('the_geom');
$srid = $geom->srid();
(string) $srid; // ST_SRID(the_geom);

// alternate syntaxes to retrieve the SQL expression:
$srid->sql; // ST_SRID(the_geom);
$srid->__toString(); // ST_SRID(the_geom);
```

Raw expressions can be prevented from going to bindings by wrapping them in an
Expression object:

```php
$geom = new Geometry('geom');

// Works as expected
$bufferSize = new Expression('3 + 5');
$buf1 = $geom->buffer($bufferSize);
(string) $buf1; // ST_Buffer(geom, 3 + 5)

// Expressions can also have bindings
$dynamicBuffer = new Expression('bufpad + ?', [3]);
$buf2 = $geom->buffer($dynamicBuffer);
(string) $buf2; // ST_Buffer(geom, bufpad + ?)
$buf2->bindings; // [3]
```

Initiate objects using constructors

```php
Sfc::pointFromText('POINT(-71.064544 42.28787)')->X();
// Produces ST_X(ST_PointFromText(?)) with binding 'POINT(-71.064544 42.28787)'
```

Use grammar-specific constructors and methods:

```php
PostGIS\Sfc::makePoint(1, 3)->setSRID(3059);
// Produces ST_SetSRID(ST_MakePoint(?, ?), ?) with bindings [1, 3, 3059]

SpatiaLite\Sfc::makePoint(1, 3)->setSRID(3059);
// Produces SetSRID(MakePoint(?, ?), ?) with bindings [1, 3, 3059]
```

## Usage examples

This section presents some plain examples in plain PDO.

Query a relation between columns `yard` and `road`:

```php
$yard = new Geometry('yard');
$road = new Geometry('road');

$expr = $yard->intersects($road);

$statement = $pdo->prepare("
	SELECT *
	FROM features
	WHERE $expr
");

$statement->execute($expr->bindings);
```

Query a column against a raw statement:

```php
$box = Geometry::fromMethod('ST_MakeEnvelope', 0, 0, 1, 3);

// You may skip trivial `new Geometry('geom')` and just supply the column name
// or any other SQL string.
$contains = $box->contains('geom');
// produces ST_Contains(ST_MakeEnvelope(?, ?, ?, ?), geom)

$statement = $pdo->prepare("
	SELECT *
	FROM features
	WHERE
		created_at > ? 
		AND $contains
");

// merge bindings with other bindings
$statement->execute([$createdFrom, ...$contains->bindings]);
```

Set a value:

```php
$point = new Point('ST_MakePoint(?, ?)', [2, 7]);
// Equivalent to:
// $point = Point::fromMethod('ST_MakePoint', [2, 7]);

$statement = $pdo->prepare("
	UPDATE features
	SET location = $point
	WHERE id = ?
");

// merge bindings with other bindings
$statement->execute([...$point->bindings, $id]);
```

## Scope and goals

The main goal is to support creation of PostGIS expressions which follows the
ArcSDE implementation. If method names are different, we should have aliases
to support PostGIS naming. If arguments are different, we should strive to
support all cases.

MySQL, MariaDB and SpatiaLite support would also be nice.

However, at this point in time, this is not supposed to be a compatibility
layer between the databases. If the same function does different things on
different databases, we are not homogenizing the behaviour. We just let you
call the function as is.

A homogenization layer might be useful, but that's another step, after the raw
builder.

### Roadmap

- Document internals (class, trait & contract modelling; callFromMethod, wrap etc)
- All the SFA model
- All the other SFA-SQL functions
- Internal support for return and arg types (e.g. `IntExpression`, `AreaExpression`)
- PostGIS specific stuff like constructors, additional args, geography stuff and so on
- Testing support, including a SpatiaLite driver and ability to replace "drivers"
- Laravel query builder and Eloquent (casts, setting, queries...) integration
- MariaDB support

## Architecture

Some implementation details to help organizing the stuff.

### Expressions

The main building block is the `Expression` class that represents an SQL
expression along with bindings. All the geometry classes are subclasses of
`Expression`. All expressions have two public properties and they are stringable:

```php
$expression->sql; // string
$expression->bindings; // array
(string) $expression; // same as $expression->sql
```

There are three ways to create any expression object:

```php
// the constructor allows specifying sql and optionally bindings
new Expression('mycolumn');
new Expression('count(mycolumn)');
new Expression('? + ?', [1, 3]);
// You can also instantiate any subclass of expression
// here's an expression that refers to your location column and knows that
// it represents a point-typed value
new Point('the_location');

// the make factory can instantiate an expression as well
Expression::make('mycolumn');
// it can wrap an existing expression to cast it to another type:
Geometry::make($someExpression); // return a Geometry with the same $sql and $bindings as $someExpression has
// the goal is to enforce type — it only accepts strings or subclasses
// i.e. the argument of Expression::make is covariant and violates Liskov substitution principle
Geometry::make(new Geometry('the_location')); // ok
Geometry::make(new Point('the_location')); // ok, point can be treated as geometry
Point::make(new Geometry('the_location')); // throws InvalidExpressionType — arbitrary geometry can't be treated as a point
Geometry::make('mygeom'); // ok, we trust you know what you're doing

// the fromMethod factory constructs an SQL statement calling a function
Expression::fromMethod('VERSION'); // makes an expression with $sql equal to VERSION()
// it puts raw args as bindings
Point::fromMethod('ST_MakePoint', 23, 56); // $sql is ST_MakeLine(?, ?) and $bindings is [23, 56]
// expression args are inserted as args
LineString::fromMethod('ST_MakeLine', new Point('start_point_col'), new Point('end_point_col')); // $sql is ST_MakeLine(start_point_col, end_point_col)
// expression arg bindings are merged
$point1 = Point::fromMethod('POINT', 23, 56);
$point2 = Point::fromMethod('POINT', 23, 57);
LineString::fromMethod('ST_MakeLine', $point1, $point2); // $sql is ST_MakeLine(POINT(?, ?), POINT(?, ?)) and $bindings is [23, 56, 23, 57]
```

### Expression subclasses

The goal of expression subclasses is to know what type of object we are dealing
with and what methods are available on it.

```php
$point = new Point('some_col');
$point->x(); // an Expression with $sql equal to ST_X(some_col)

$line = new LineString('line_column');
$endPoint = $line->pointN(-1); // a Point with $sql = ST_PointN(line_column, ?) and $bindings [-1]
$endPoint->x(); // and expression with $sql = ST_X(ST_PointN(line_column, ?)) and $bindings = [-1]
$endPoint->pointN(-1); // throws exception as you cant ST_PointN on a point
```

Currently we only have expression subclasses for geometry, but we might have
other types (integer valued expression, area valued expression and so on) later.

### Hierarchy and composition

The geometry class hierarchy as defined in the OGC spec along with the required
methods is defined in interfaces in `OGC\Contracts`.

The default mapping from OOP methods to SQL as described in the OGC spec is
implemented in `OGC\Traits`.

The classes are built somewhat like this (pseudocode):

```php
class PostGIS\Line extends PostGIS\LineString implements OGC\Contracts\Line
{
	// default implementation
	use OGC\Traits\Line;

	// PostGIS-specific overrides and additions
	public function someLineMethod($anArg)
	{
		//
	}
}
```

We also include classes in the `OGC` namespace that implement everything as
defined in the spec. Seemingly there are no DBMSs that implement everything
exactly like that, but let it be for now.

Btw if an OGC-defined method is not implemented in the particular DBMS, you
will get a MethodNotImplemented exception thrown.

### Constructors

Constructors are implemented in classes named `Sfc` (simple feature constructor).

You have the defaults in `OGC\Sfc`:

```php
Sfc::pointFromText('POINT(23 56)'); // returns a Point with $sql = ST_PointFromText(?) and $bindings = ['POINT(23 56)']
```

And the more specific stuff in the specific `Sfc`s:

```php
PostGIS\Sfc::makePointM(23, 56, 5); // returns a Point with $sql = ST_MakePointM(?, ?, ?) and $bindings = [23, 56, 5]
```

The `Sfc` classes also have the `[type]FromMethod` magic methods, e.g.
```php
PostGIS\Sfc::pointFromMethod(...$args); // same as PostGIS\Point::fromMethod(...$args)
MySQL\Sfc::pointFromMethod(...$args); // same as MySQL\Point::fromMethod(...$args)
```

Which is useful when you want to share functionality across Sfc classes but
need to return a geometry class belonging to the particular DBMS.


## Terminology and references

- **SF** — [Simple Features](https://en.wikipedia.org/wiki/Simple_Features),
the geometries and the interface to interact with them.
- **SFA** — Simple Feature Access, same thing as Simple Features.
- **OGC** — Open Geospatial Consortium
- **SQL/MM** — SQL multimedia schema defined by ISO/IEC 13249, including SQL/MM
spatial defined in ISO/IEC 13249-3.
- **SFA-CA** — Geometry model defined by OGC in [SFA part 1](https://www.ogc.org/standards/sfa)
- **SFA-SQL** — SQL schema for simple features defined by OGC in [SFA part 2](https://www.ogc.org/standards/sfs)
- **ArcSDE** — the thing in ArcGIS suite that communicates with a relational
database. Some RDBMS treat it as a de facto standard and sometimes follows it
over SFA (dropping SFA methods that ArcSDE is not using https://trac.osgeo.org/postgis/changeset/8680)
or SQL/MM (implemented for ArcSDE not SQL/MM https://postgis.net/docs/ST_OrderingEquals.html).

Our API mainly tries to support the 
[OpenGIS SFA standard](https://www.ogc.org/standards/sfa), but it might also
include some common aliases from ArcSDE and others.

The supportable SQL is described in multiple standards and other resources:

- [OpenGIS SFA part 2](https://www.ogc.org/standards/sfs)
- SQL/MM (ISO/IEC 13249-3), no free access
- [ArcSDE](https://desktop.arcgis.com/en/arcmap/latest/manage-data/using-sql-with-gdbs/a-quick-tour-of-sql-functions-used-with-st-geometry.htm)
- [PostGIS](https://postgis.net/docs/reference.html)

Some might also be interested to see ISO 19125 (SFA), ISO/IEC 13249-3 (SQL/MM spatial)
and ISO 19107 (spatial schema).

## Similar projects

### brick/geo

https://github.com/brick/geo

Allows doing GIS stuff inside PHP, using an underlying engine like GEOS ext,
PostGIS and others. Includes SF query engines for various databases.

### brick/geo-doctrine

https://github.com/brick/geo-doctrine

GIS mappings for Doctrine and functions for DQL.

### GeoPHP

https://geophp.net/

Does GIS stuff inside PHP and allows communicating with DB using WK and other
formats.

### vincjo/spatialite

https://github.com/vincjo/spatialite

PHP interface to SpatiaLite.

### elevenlab/php-ogc

https://github.com/eleven-lab/php-ogc

Implementation of SFA types in PHP.

### elevenlab/laravel-geo

https://github.com/eleven-lab/laravel-geo

Extending Laravel query builder and Eloquent with some of the SFA-SQL methods.

### mstaack/laravel-postgis

https://github.com/mstaack/laravel-postgis

Implementation of SFA types with custom interface and support for those objects
in Eloquent. Also adds support for these types in migrations.

### geo-io/geometry

https://github.com/geo-io/geometry

Implementation of SFA object oriented features in plain PHP. Part of project
[Geo I/O](https://github.com/geo-io) that includes other Geo PHP tools as well.

### jsor/doctrine-postgis

https://github.com/jsor/doctrine-postgis

PostGIS support for Doctrine, see the [supported functions](https://github.com/jsor/doctrine-postgis/blob/main/docs/function-index.md).
We should strive to support the same.
