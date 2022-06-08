<?php

namespace TontonsB\SF;

use TontonsB\SF\OGC\Geometry;
use TontonsB\SF\OGC\GeometryCollection;
use TontonsB\SF\OGC\Point;

/**
 * Implements constructors according to
 * Table 5 — SQL functions for constructing a geometric object given its
 * Well-known Binary Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */

// TODO: consider adding Table 6 — Optional SQL functions for constructing a
// geometric object given its Well-known Binary Representation

/**
 * Create a Geometry from WKB.
 *
 * If SRID is omitted, we will also omit it.
 */
function geomFromWKB(string $WKBGeometry, int $SRID = null): Geometry
{
	return is_null($SRID)
		? Geometry::fromMethod('ST_GeomFromWKB', $WKBGeometry)
		: Geometry::fromMethod('ST_GeomFromWKB', $WKBGeometry, $SRID);
}


/**
 * Create a Point from WKB.
 *
 * If SRID is omitted, we will also omit it.
 */
function pointFromWKB(string $WKBPoint, int $SRID = null): Point
{
	return is_null($SRID)
		? Point::fromMethod('ST_PointFromWKB', $WKBPoint)
		: Point::fromMethod('ST_PointFromWKB', $WKBPoint, $SRID);
}

// TODO: lineFromWKB
// TODO: polyFromWKB
// TODO: mPointFromWKB
// TODO: mLineFromWKB
// TODO: mPolyFromWKB

/**
 * Create a GeometryCollection from WKB.
 *
 * If SRID is omitted, we will also omit it.
 */
function geomCollFromWKB(string $WKBGeomCollection, int $SRID = null): GeometryCollection
{
	return is_null($SRID)
		? GeometryCollection::fromMethod('ST_GeomCollFromWKB', $WKBGeomCollection)
		: GeometryCollection::fromMethod('ST_GeomCollFromWKB', $WKBGeomCollection, $SRID);
}
