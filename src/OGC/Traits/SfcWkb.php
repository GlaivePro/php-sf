<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\OGC\Contracts\Geometry;
use TontonsB\SF\OGC\Contracts\GeometryCollection;
use TontonsB\SF\OGC\Contracts\LineString;
use TontonsB\SF\OGC\Contracts\Point;
use TontonsB\SF\OGC\Contracts\Polygon;

/**
 * Implements constructors according to
 * Table 5 — SQL functions for constructing a geometric object given its
 * Well-known Binary Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
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

	/**
	 * Create a LineString from WKB.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function lineFromWKB(string $WKBLineString, int $SRID = null): LineString
	{
		return is_null($SRID)
			? static::lineStringFromMethod('ST_LineFromWKB', $WKBLineString)
			: static::lineStringFromMethod('ST_LineFromWKB', $WKBLineString, $SRID);
	}

	/**
	 * Create a Polygon from WKB.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function polyFromWKB(string $WKBPolygon, int $SRID = null): Polygon
	{
		return is_null($SRID)
			? static::polygonFromMethod('ST_PolyFromWKB', $WKBPolygon)
			: static::polygonFromMethod('ST_PolyFromWKB', $WKBPolygon, $SRID);
	}

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
