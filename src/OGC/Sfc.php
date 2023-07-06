<?php

namespace GlaivePro\SF\OGC;

/**
 * Simple feature consrtuctors for OGC model.
 *
 * Provides constructors as defined in "OpenGIS® Implementation Standard for
 * Geographic information - Simple feature access - Part 2: SQL option"
 * Version 1.1.0
 */
class Sfc
{
	use Traits\SfcWkb;
	use Traits\SfcWkbOptional;
	use Traits\SfcWkt;
	use Traits\SfcWktOptional;

	public static function __callStatic($method, $args)
	{
		if (str_ends_with($method, 'FromMethod'))
			return static::callFromMethod(substr($method, 0, -10), $args);

		throw new \BadMethodCallException('Unknown static method '.static::class.'::'.$method.'.'); // @codeCoverageIgnore
	}

	/**
	 * Calls `fromMethod` on the desired class.
	 */
	protected static function callFromMethod(string $method, array $args): Contracts\Geometry
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
}
