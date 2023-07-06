<?php

namespace GlaivePro\SF\OGC\Traits;

use GlaivePro\SF\OGC\Contracts\MultiPolygon;
use GlaivePro\SF\OGC\Contracts\Polygon;

/**
 * Implements constructors according to
 * Table 6 — Optional SQL functions for constructing a geometric object given
 * its Well-known Binary Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait SfcWkbOptional
{
	/**
	 * Create a Polygon from MultiLineString WKB.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function bdPolyFromWKB(string $WKBMultiLineString, int $SRID = null): Polygon
	{
		return \is_null($SRID)
			? static::polygonFromMethod('ST_BdPolyFromWKB', $WKBMultiLineString)
			: static::polygonFromMethod('ST_BdPolyFromWKB', $WKBMultiLineString, $SRID);
	}

	/**
	 * Create a MultiPolygon from MultiLineString WKB.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function bdMPolyFromWKB(string $WKBMultiLineString, int $SRID = null): MultiPolygon
	{
		return \is_null($SRID)
			? static::multiPolygonFromMethod('ST_BdMPolyFromWKB', $WKBMultiLineString)
			: static::multiPolygonFromMethod('ST_BdMPolyFromWKB', $WKBMultiLineString, $SRID);
	}
}
