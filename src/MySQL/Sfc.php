<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Sfc as OGCSfc;

/**
 * Implements constructors available in MySQL.
 */
class Sfc extends OGCSfc
{
	/**
	 * Calls `fromMethod` on the desired class.
	 *
	 * We have to specify PostGIS-specific classes here.
	 */
	protected static function callFromMethod(string $method, array $args): Geometry
	{
		$class = match ($method) {
			'geometry' => Geometry::class,
			'geometryCollection' => GeometryCollection::class,
			'lineString' => LineString::class,
			'multiCurve' => MultiCurve::class,
			'multiLineString' => MultiLineString::class,
			'multiPoint' => MultiPoint::class,
			'multiPolygon' => MultiPolygon::class,
			'point' => Point::class,
			'polygon' => Polygon::class,
		};

		return $class::fromMethod(...$args);
	}

	/**
	 * Create a Point.
	 *
	 * Unlike POINT in MySQL, this also accepts POINT(x, y, srid)
	 * and will set the SRID on the created POINT in such case.
	 */
	public static function point(float $x, float $y, int $srid = null): Point
	{
		$point =  Point::fromMethod('Point', $x, $y);

		if (\is_null($srid))
			return $point;

		return $point->setSRID($srid);
	}

	/**
	 * Not implemented in MySQL.
	 */
	public static function bdPolyFromWKB(string $WKBMultiLineString, int $SRID = null): Polygon
	{
		throw new MethodNotImplemented;
	}

	/**
	 * Not implemented in MySQL.
	 */
	public static function bdPolyFromText(string $multiLineStringTaggedText, int $SRID = null): Polygon
	{
		throw new MethodNotImplemented;
	}

	/**
	 * Not implemented in MySQL.
	 */
	public static function bdMPolyFromWKB(string $WKBMultiLineString, int $SRID = null): MultiPolygon
	{
		throw new MethodNotImplemented;
	}

	/**
	 * Not implemented in MySQL.
	 */
	public static function bdMPolyFromText(string $multiLineStringTaggedText, int $SRID = null): MultiPolygon
	{
		throw new MethodNotImplemented;
	}

}
