<?php

namespace TontonsB\SF;

/**
 * Implements geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 11 — SQL functions on type Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class Curve extends Geometry
{
	public function length(): Expression // Float-valued expression
	{
		return $this->wrap('ST_Length');
	}

	public function startPoint(): Point
	{
		return Point::fromMethod('ST_StartPoint', $this);
	}

	public function endPoint(): Point
	{
		return Point::fromMethod('ST_EndPoint', $this);
	}

	public function isClosed(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsClosed');
	}

	public function isRing(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsRing');
	}
}
