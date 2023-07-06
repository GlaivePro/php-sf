<?php

namespace GlaivePro\SF\OGC\Traits;

use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts;

/**
 * Implements geometry model according to
 * 6.1.11 Polygon, Triangle
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.13 SQL functions on type Polygon
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 */
trait Polygon
{
	public function exteriorRing(): Contracts\LineString
	{
		return $this->lineStringFromMethod('ST_ExteriorRing', $this);
	}

	public function numInteriorRing(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumInteriorRing');
	}

	public function interiorRingN(int|Expression $n): Contracts\LineString
	{
		// We are explicitly NOT wrapping $n in an Expression, because
		// raw numeric values should go to bindings.
		return $this->lineStringFromMethod(
			'ST_InteriorRingN',
			$this,
			$n,
		);
	}
}
