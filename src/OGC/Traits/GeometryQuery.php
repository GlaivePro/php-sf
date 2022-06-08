<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts\Geometry as GeometryInterface;
use TontonsB\SF\OGC\Geometry;

/**
 * Supports analysis methods on geometry object according to
 * 6.1.2.3 Methods for testing spatial relations between geometric objects
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 18 — SQL functions that test spatial relationships
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 *
 * TODO: Check arg types to disallow Expression args (currently they pass due
 * to getting coerced to string).
 */
trait GeometryQuery
{
	public function equals(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Equals', $another);
	}

	public function disjoint(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Disjoint', $another);
	}

	public function intersects(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Intersects', $another);
	}

	public function touches(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Touches', $another);
	}

	public function crosses(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Crosses', $another);
	}

	public function within(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Within', $another);
	}

	public function contains(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Contains', $another);
	}

	public function overlaps(GeometryInterface|string $another): Expression // Boolean-valued expression
	{
		return $this->query('ST_Overlaps', $another);
	}

	/**
	 * This is only with the matrix arg.
	 *
	 * TODO: implement the other variants https://postgis.net/docs/ST_Relate.html
	 * for full PostGIS support.
	 */
	public function relate(GeometryInterface|string $another, string $matrix): Expression // Boolean-valued expression
	{
		return Expression::fromMethod(
			'ST_Relate',
			$this,
			Geometry::make($another),
			$matrix,
		);
	}

	/**
	 * TODO: support the optional arg supported by PostGIS
	 * https://postgis.net/docs/ST_LocateAlong.html
	 *
	 * Note that the arg is double according to spec but float8 in PostGIS.
	 */
	public function locateAlong(float $mValue): GeometryInterface
	{
		return Geometry::fromMethod(
			'ST_LocateAlong',
			$this,
			$mValue,
		);
	}

	/**
	 * TODO: support the optional arg supported by PostGIS
	 * https://postgis.net/docs/ST_LocateBetween.html
	 *
	 * Note that args are double according to spec but float8 in PostGIS.
	 */
	public function locateBetween(float $mStart, float $mEnd): GeometryInterface
	{
		return Geometry::fromMethod(
			'ST_LocateBetween',
			$this,
			$mStart,
			$mEnd,
		);
	}
}
