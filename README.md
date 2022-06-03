# PHP Simple Features SQL

Build SFA-SQL (SQL/MM) expressions using SFA-CA syntax.

## Examples

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

## Scope and goals

The main goal is to support creation of PostGIS expressions which follows the
ArcSDE implementation. If method names are different, we should have aliases
to support PostGIS naming. If arguments are different, we should strive to
support all cases.

## Terminology and references

- **SF** — [Simple Features](https://en.wikipedia.org/wiki/Simple_Features),
the geometries and the interface to interact with them.
- **SFA** — Simple Feature Access, same thing as Simple Features.

Our API mainly tries to support the 
[OpenGIS SFA standard](https://www.ogc.org/standards/sfa), but it might also
include some common aliases from ArcSDE and others.

The supportable SQL is described in multiple standards and other resources:

- [OpenGIS SFA part 2](https://www.ogc.org/standards/sfs)
- [SQL/MM](https://subs.emis.de/LNI/Proceedings/Proceedings26/GI-Proceedings.26-17.pdf)
- [ArcSDE](https://desktop.arcgis.com/en/arcmap/latest/manage-data/using-sql-with-gdbs/a-quick-tour-of-sql-functions-used-with-st-geometry.htm)
- [PostGIS](https://postgis.net/docs/reference.html)

Some might also be interested to see ISO 19125 (SFA) and ISO 19107 (spatial schema).

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
