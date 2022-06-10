<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Sfc as OGCSfc;

/**
 * Implements constructors available in PostGIS.
 *
 * Note that some of these functions may also be available in other DBs, but
 * the usage may be different. See
 * https://desktop.arcgis.com/en/arcmap/latest/manage-data/using-sql-with-gdbs/constructor-functions.htm
 */

// TODO: This is nowhere near completed :)
// TODO: Consider allowing expressions in the constructors
class Sfc extends OGCSfc
{
	/**
	 * Calls `fromMethod` on the desired class.
	 *
	 * We have to specify PostGIS-specific classes here.
	 */
	protected static function callFromMethod(string $method, array $args): Geometry
	{
		$class = match($method) {
			'geometry' => Geometry::class,
			'point' => Point::class,
			'lineString' => LineString::class,
			'polygon' => Polygon::class,
		};

		return $class::fromMethod(...$args);
	}

	/**
	 * Create a Point.
	 *
	 * Unlike ST_MakePoint in PostGIS, this also accepts
	 * makePoint(x: $x, y: $y, m: $m) and will use ST_MakePointM in such case.
	 *
	 * If the optional args are omitted, we will also omit them.
	 */
	public static function makePoint(float $x, float $y, float $z = null, float $m = null): Point
	{
		if (is_null($z) && is_null($m))
			return Point::fromMethod('ST_MakePoint', $x, $y);

		if (is_null($m))
			return Point::fromMethod('ST_MakePoint', $x, $y, $z);

		if (is_null($z))
			return static::makePointM($x, $y, $m);

		return Point::fromMethod('ST_MakePoint', $x, $y, $z, $m);
	}

	/**
	 * Create a Point with the measure coordinate.
	 */
	public static function makePointM(float $x, float $y, float $m): Point
	{
		return Point::fromMethod('ST_MakePointM', $x, $y, $m);
	}

	/**
	 * Create a Point.
	 *
	 * Unlike ST_Point in PostGIS, this also accepts point($x, $y, m: $m),
	 * point($x, $y, z: $z) and other combinations and will select the appropriate
	 * method among ST_Point, ST_PointZ, ST_PointM, ST_PointZM.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function point(float $x, float $y, int $srid = null, float $z = null, float $m = null): Point
	{
		if (is_null($z) && is_null($m))
			return is_null($srid)
				? Point::fromMethod('ST_Point', $x, $y)
				: Point::fromMethod('ST_Point', $x, $y, $srid);

		if (is_null($m))
			return static::pointZ($x, $y, $z, $srid);

		if (is_null($z))
			return static::pointM($x, $y, $m, $srid);

		return static::pointZM($x, $y, $z, $m, $srid);
	}

	/**
	 * Create a Point with X, Y and Z.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function pointZ(float $x, float $y, float $z, int $srid = null): Point
	{
		return is_null($srid)
			? Point::fromMethod('ST_PointZ', $x, $y, $z)
			: Point::fromMethod('ST_PointZ', $x, $y, $z, $srid);
	}

	/**
	 * Create a Point with X, Y and M.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function pointM(float $x, float $y, float $m, int $srid = null): Point
	{
		return is_null($srid)
			? Point::fromMethod('ST_PointM', $x, $y, $m)
			: Point::fromMethod('ST_PointM', $x, $y, $m, $srid);
	}

	/**
	 * Create a Point with X, Y, Z and M.
	 *
	 * If SRID is omitted, we will also omit it.
	 */
	public static function pointZM(float $x, float $y, float $z, float $m, int $srid = null): Point
	{
		return is_null($srid)
			? Point::fromMethod('ST_PointZM', $x, $y, $z, $m)
			: Point::fromMethod('ST_PointZM', $x, $y, $z, $m, $srid);
	}

	public static function makeLine(string|Expression ...$geometry): LineString
	{
		return LineString::fromMethod('ST_MakeLine', ...$geometry);
	}
}
