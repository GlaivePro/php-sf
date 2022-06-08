<?php

namespace TontonsB\SF;

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
class GeometryCollection extends Geometry
{
	public function numGeometries(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumGeometries');
	}

	public function geometryN(int|Expression $n): Geometry // Integer-valued expression
	{
		// We are explicitly NOT wrapping $n in an Expression, because
		// raw numeric values should go to bindings.
		return Geometry::fromMethod(
			'ST_GeometryN',
			$this,
			$n,
		);
	}
}
