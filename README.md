# PHP Simple Features SQL

Build SFA-SQL (SQL/MM) expressions using SFA-CA syntax.



## Terminology and standards

- **SF** — [Simple Features](https://en.wikipedia.org/wiki/Simple_Features),
the geometries and the interface to interact with them.
- **SFA** — Simple Feature Access, same thing as Simple Features.
- **WK** — "well known" formats like WKT, WEKT, WKB, EWKB.

The main standards considered in this project ar the OpenGIS ones:

- https://www.ogc.org/standards/sfa
- https://www.ogc.org/standards/sfs

Also see ISO 19125 (SFA) and ISO 19107 (spatial schema).

## Similar projects

### brick/geo

https://github.com/brick/geo

Allows doing GIS stuff inside PHP, using an underlying engine like GEOS ext,
PostGIS and others. Includes SF query engines for various databases.

### GeoPHP

https://geophp.net/

Does GIS stuff inside PHP and allows communicating with DB using WK and other
formats.

### vincjo/spatialite

https://github.com/vincjo/spatialite

PHP interface to SpatiaLite.
