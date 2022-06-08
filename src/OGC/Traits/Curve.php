<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts;
use TontonsB\SF\OGC\Point;

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
trait Curve
{
	public function length(): Expression // Float-valued expression
	{
		return $this->wrap('ST_Length');
	}

	public function startPoint(): Contracts\Point
	{
		return $this->pointFromMethod('ST_StartPoint', $this);
	}

	public function endPoint(): Contracts\Point
	{
		return $this->pointFromMethod('ST_EndPoint', $this);
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
