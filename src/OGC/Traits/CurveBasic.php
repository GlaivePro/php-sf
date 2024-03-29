<?php

namespace GlaivePro\SF\OGC\Traits;

use GlaivePro\SF\Expression;

/**
 * Returns SQL statements common to
 * Table 11 — SQL functions on type Curve
 * Table 16 — SQL functions on type MultiCurve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait CurveBasic
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
