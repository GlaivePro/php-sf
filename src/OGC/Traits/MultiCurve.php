<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.8 MultiCurve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 16 — SQL functions on type MultiCurve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 *
 * TODO: reuse functions from Curve, extract into something like GenericCurve
 * or CurveBasic.
 */
trait MultiCurve
{
	public function length(): Expression // Float-valued expression
	{
		return $this->wrap('ST_Length');
	}

	public function isClosed(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsClosed');
	}
}
