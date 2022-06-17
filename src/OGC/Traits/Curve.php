<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts;

/**
 * Implements geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 11 — SQL functions on type Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait Curve
{
	use CurveBasic;

	public function startPoint(): Contracts\Point
	{
		return $this->pointFromMethod('ST_StartPoint', $this);
	}

	public function endPoint(): Contracts\Point
	{
		return $this->pointFromMethod('ST_EndPoint', $this);
	}

	public function isRing(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsRing');
	}
}
