<?php

namespace TontonsB\SF\OGC;

/**
 * Implements constructors according to
 * Table 5 — SQL functions for constructing a geometric object given its
 * Well-known Binary Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */

// TODO: consider adding Table 6 — Optional SQL functions for constructing a
// geometric object given its Well-known Binary Representation

trait SfcWkb
{
	/**
	 * Create a Geometry from WKB.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function geomFromWKB(string $WKBGeometry, int $SRID = null): Geometry
	{
		return is_null($SRID)
			? static::geometryFromMethod('ST_GeomFromWKB', $WKBGeometry)
			: static::geometryFromMethod('ST_GeomFromWKB', $WKBGeometry, $SRID);
	}


	/**
	 * Create a Point from WKB.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function pointFromWKB(string $WKBPoint, int $SRID = null): Point
	{
		return is_null($SRID)
			? static::pointFromMethod('ST_PointFromWKB', $WKBPoint)
			: static::pointFromMethod('ST_PointFromWKB', $WKBPoint, $SRID);
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
	public static function geomCollFromWKB(string $WKBGeomCollection, int $SRID = null): GeometryCollection
	{
		return is_null($SRID)
			? static::geometryCollectionFromMethod('ST_GeomCollFromWKB', $WKBGeomCollection)
			: static::geometryCollectionFromMethod('ST_GeomCollFromWKB', $WKBGeomCollection, $SRID);
	}
}
