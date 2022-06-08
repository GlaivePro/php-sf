<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts;
use TontonsB\SF\OGC\Geometry;

/**
 * Implements geometry model according to
 * 6.1.3 GeometryCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 15 — SQL functions on type GeomCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
trait GeometryCollection
{
	public function numGeometries(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumGeometries');
	}

	public function geometryN(int|Expression $n): Contracts\Geometry // Integer-valued expression
	{
		// We are explicitly NOT wrapping $n in an Expression, because
		// raw numeric values should go to bindings.
		return $this->geometryFromMethod(
			'ST_GeometryN',
			$this,
			$n,
		);
	}
}
