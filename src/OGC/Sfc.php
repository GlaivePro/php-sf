<?php

namespace TontonsB\SF\OGC;

/**
 * Simple feature consrtuctors for OGC model.
 *
 * Provides constructors as defined in "OpenGIS® Implementation Standard for
 * Geographic information - Simple feature access - Part 2: SQL option"
 */
class Sfc
{
	use SfcWkt;
	use SfcWkb;

	public static function __callStatic($method, $args)
	{
		if (str_ends_with($method, 'FromMethod'))
			return static::callFromMethod(substr($method, 0, -10), $args);

		throw new \BadMethodCallException('Unknown static method '.static::class.'::'.$method.'.'); // @codeCoverageIgnore
	}

	/**
	 * Calls `fromMethod` on the desired class.
	 */
	protected static function callFromMethod(string $method, array $args): Geometry
	{
		$class = match($method) {
			'geometry' => Geometry::class,
			'point' => Point::class,
			// 'curve' => Curve::class,
			// 'surface' => Surface::class,
			'geometryCollection' => GeometryCollection::class,
		};

		return $class::fromMethod(...$args);
	}
}
