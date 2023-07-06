<?php

namespace GlaivePro\SF\OGC\Traits;

use GlaivePro\SF\OGC\Contracts;

/**
 * Implements geometry model according to
 * 6.1.10 Surface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 13 — SQL functions on type Surface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait Surface
{
	use SurfaceBasic;

	public function boundary(): Contracts\MultiCurve
	{
		return $this->multiCurveFromMethod('ST_Boundary', $this);
	}
}
