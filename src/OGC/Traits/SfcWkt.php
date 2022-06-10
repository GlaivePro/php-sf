<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\OGC\Contracts\Geometry;
use TontonsB\SF\OGC\Contracts\GeometryCollection;
use TontonsB\SF\OGC\Contracts\Point;
use TontonsB\SF\OGC\Contracts\LineString;
use TontonsB\SF\OGC\Contracts\Polygon;

/**
 * Implements constructors according to
 * Table 3 — SQL functions for constructing a geometric object given its
 * Well-known Text Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait SfcWkt
{
	/**
	 * Create a Geometry from WKT.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function geomFromText(string $geometryTaggedText, int $SRID = null): Geometry
	{
		return is_null($SRID)
			? static::geometryFromMethod('ST_GeomFromText', $geometryTaggedText)
			: static::geometryFromMethod('ST_GeomFromText', $geometryTaggedText, $SRID);
	}

	/**
	 * Create a Point from WKT.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function pointFromText(string $pointTaggedText, int $SRID = null): Point
	{
		return is_null($SRID)
			? static::pointFromMethod('ST_PointFromText', $pointTaggedText)
			: static::pointFromMethod('ST_PointFromText', $pointTaggedText, $SRID);
	}

	/**
	 * Create a LineString from WKT.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function lineFromText(string $lineStringTaggedText, int $SRID = null): LineString
	{
		return is_null($SRID)
			? static::lineStringFromMethod('ST_LineFromText', $lineStringTaggedText)
			: static::lineStringFromMethod('ST_LineFromText', $lineStringTaggedText, $SRID);
	}

	/**
	 * Create a Polygon from WKT.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function polyFromText(string $polygonTaggedText, int $SRID = null): Polygon
	{
		return is_null($SRID)
			? static::polygonFromMethod('ST_PolyFromText', $polygonTaggedText)
			: static::polygonFromMethod('ST_PolyFromText', $polygonTaggedText, $SRID);
	}

	// TODO: mPointFromText
	// TODO: mLineFromText
	// TODO: mPolyFromText

	/**
	 * Create a GeometryCollection from WKT.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function geomCollFromText(string $geometryCollectionTaggedText, int $SRID = null): GeometryCollection
	{
		return is_null($SRID)
			? static::geometryCollectionFromMethod('ST_GeomCollFromText', $geometryCollectionTaggedText)
			: static::geometryCollectionFromMethod('ST_GeomCollFromText', $geometryCollectionTaggedText, $SRID);
	}
}
