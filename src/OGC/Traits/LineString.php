<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts;

/**
 * Implements geometry model according to
 * 6.1.7 LineString, Line, LinearRing
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 12 — SQL functions on type LineString
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait LineString
{
	public function numPoints(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumPoints');
	}

	public function pointN(int|Expression $n): Contracts\Point
	{
		// We are explicitly NOT wrapping $n in an Expression, because
		// raw numeric values should go to bindings.
		return $this->pointFromMethod(
			'ST_PointN',
			$this,
			$n,
		);
	}
}
