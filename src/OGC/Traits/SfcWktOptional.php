<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\OGC\Contracts\Polygon;

/**
 * Implements constructors according to
 * Table 4 — Optional SQL functions for constructing a geometric object given
 * its Well-known Text Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait SfcWktOptional
{
	/**
	 * Create a Polygon from MultiLineString WKT.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function bdPolyFromText(string $multiLineStringTaggedText, int $SRID = null): Polygon
	{
		return is_null($SRID)
			? static::polygonFromMethod('ST_BdPolyFromText', $multiLineStringTaggedText)
			: static::polygonFromMethod('ST_BdPolyFromText', $multiLineStringTaggedText, $SRID);
	}

	// TODO: bdMPolyFromText
}
