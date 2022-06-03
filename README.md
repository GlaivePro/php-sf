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

### Roadmap

- All the SFA model
- All the other SFA-SQL functions
- Internal support for return and arg types (e.g. `IntExpression`, `AreaExpression`)
- PostGIS specific stuff like additional args, geography stuff and so on
- Laravel query builder and Eloquent (casts, setting, queries...) integration

## Terminology and references

- **SF** — [Simple Features](https://en.wikipedia.org/wiki/Simple_Features),
the geometries and the interface to interact with them.
- **SFA** — Simple Feature Access, same thing as Simple Features.
- **OGC** — Open Geospatial Consortium
- **SQL/MM** — SQL multimedia schema defined by ISO/IEC 13249, including SQL/MM
spatial defined in ISO/IEC 13249-3.
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
- [SQL/MM](https://subs.emis.de/LNI/Proceedings/Proceedings26/GI-Proceedings.26-17.pdf)
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
