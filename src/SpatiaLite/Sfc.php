<?php

namespace TontonsB\SF\SpatiaLite;

use TontonsB\SF\OGC\Sfc as OGCSfc;

/**
 * Implements constructors available in SpatiaLite.
 *
 * Note that some of these functions may also be available in other DBs, but
 * the usage may be different. See
 * https://desktop.arcgis.com/en/arcmap/latest/manage-data/using-sql-with-gdbs/constructor-functions.htm
 */

// TODO: This is nowhere near completed :)

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
			// 'curve' => Curve::class,
			// 'surface' => Surface::class,
			// 'geometryCollection' => GeometryCollection::class,
		};

		return $class::fromMethod(...$args);
	}

	/**
	 * Create a Point.
	 *
	 * Unlike MakePoint in SpatiaLite, this also accepts
	 * makePoint(x: $x, y: $y, m: $m) and will use MakePointM in such case.
	 * Similarly `z` arg is also supported using MakePointZ or MakePointZM.
	 *
	 * If the optional args are omitted, we will also omit them.
	 *
	 * TODO: Consider moving $srid to end for compatibility with PostGIS.
	 */
	public static function makePoint(float $x, float $y, int $srid = null, float $z = null, float $m = null): Point
	{
		if (\is_null($z) && \is_null($m))
			return \is_null($srid)
				? Point::fromMethod('MakePoint', $x, $y)
				: Point::fromMethod('MakePoint', $x, $y, $srid);

		if (\is_null($m))
			return static::makePointZ($x, $y, $z, $srid);

		if (\is_null($z))
			return static::makePointM($x, $y, $m, $srid);

		return static::makePointZM($x, $y, $z, $m, $srid);
	}

	/**
	 * Create a Point with X, Y and Z.
	 */
	public static function makePointZ(float $x, float $y, float $z, int $srid = null): Point
	{
		return \is_null($srid)
			? Point::fromMethod('MakePointZ', $x, $y, $z)
			: Point::fromMethod('MakePointZ', $x, $y, $z, $srid);
	}

	/**
	 * Create a Point with X, Y and M.
	 */
	public static function makePointM(float $x, float $y, float $m, int $srid = null): Point
	{
		return \is_null($srid)
			? Point::fromMethod('MakePointM', $x, $y, $m)
			: Point::fromMethod('MakePointM', $x, $y, $m, $srid);
	}

	/**
	 * Create a Point with X, Y, Z and M.
	 */
	public static function makePointZM(float $x, float $y, float $z, float $m, int $srid = null): Point
	{
		return \is_null($srid)
			? Point::fromMethod('MakePointZM', $x, $y, $z, $m)
			: Point::fromMethod('MakePointZM', $x, $y, $z, $m, $srid);
	}

	/**
	 * Create a Point.
	 *
	 * TODO: Consider supporting other args and falling back to MakePoint, so
	 * this could have a PostGIS-like interface for easy replacement.
	 */
	public static function point(float $x, float $y): Point
	{
		return Point::fromMethod('ST_Point', $x, $y);
	}
}
