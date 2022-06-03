<?php

namespace TontonsB\SF;

/**
 * Implements geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
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
