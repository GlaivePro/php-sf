<?php

namespace TontonsB\SF;

/**
 * Supports analysis methods on geometry object according to
 * 6.1.2.4 Methods that support spatial analysis
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 19 — SQL functions for distance relationships
 * and
 * Table 20 — SQL functions that implement spatial operators
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 *
 * TODO: Check arg types to disallow Expression args (currently they pass due
 * to getting coerced to string).
 */
trait GeometryAnalysis
{
	/**
	 * TODO: support the optional arg supported by PostGIS
	 * https://postgis.net/docs/ST_Distance.html
	 */
	public function distance(Geometry|string $another): Expression // Distance(float)-valued expression
	{
		return $this->query('ST_Distance', $another);
	}

	/**
	 * TODO: Limit to float|DistanceExpression argument for $distance.
	 *
	 * TODO: support the optional args supported by PostGIS
	 * https://postgis.net/docs/ST_Buffer.html
	 */
	public function buffer(float|Expression $distance): Geometry
	{
		// We are explicitly NOT wrapping $distance in an Expression, because
		// raw numeric values should go to bindings.
		return Geometry::fromMethod(
			'ST_Buffer',
			$this,
			$distance,
		);
	}

	public function convexHull(): Geometry
	{
		return Geometry::fromMethod(
			'ST_ConvexHull',
			$this,
		);
	}

	/**
	 * TODO: support the optional arg supported by PostGIS
	 * https://postgis.net/docs/ST_Intersection.html
	 */
	public function intersection(Geometry|string $another): Geometry
	{
		return $this->combine('ST_Intersection', $another);
	}

	/**
	 * TODO: support the optional args and other options supported by PostGIS
	 * https://postgis.net/docs/ST_Union.html
	 */
	public function union(Geometry|string $another): Geometry
	{
		return $this->combine('ST_Union', $another);
	}

	/**
	 * TODO: support the optional arg supported by PostGIS
	 * https://postgis.net/docs/ST_Difference.html
	 */
	public function difference(Geometry|string $another): Geometry
	{
		return $this->combine('ST_Difference', $another);
	}

	/**
	 * TODO: support the optional arg supported by PostGIS
	 * https://postgis.net/docs/ST_SymDifference.html
	 */
	public function symDifference(Geometry|string $another): Geometry
	{
		return $this->combine('ST_SymDifference', $another);
	}
}
