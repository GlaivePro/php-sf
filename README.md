# PHP Simple Features SQL

Build SFA-SQL (SQL/MM) expressions using SFA-CA syntax.

The main goal is to support creation of PostGIS expressions which follows the
ArcSDE implementation.

## Terminology and references

- **SF** — [Simple Features](https://en.wikipedia.org/wiki/Simple_Features),
the geometries and the interface to interact with them.
- **SFA** — Simple Feature Access, same thing as Simple Features.
- **WK** — "well known" formats like WKT, WEKT, WKB, EWKB.

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
