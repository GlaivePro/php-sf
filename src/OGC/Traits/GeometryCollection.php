<?php

namespace Janaseta\SF\OGC\Traits;

use Janaseta\SF\Expression;
use Janaseta\SF\OGC\Contracts;

/**
 * Implements geometry model according to
 * 6.1.3 GeometryCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 15 — SQL functions on type GeomCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait GeometryCollection
{
	public function numGeometries(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumGeometries');
	}

	public function geometryN(int|Expression $n): Contracts\Geometry
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
