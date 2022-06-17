<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\OGC\Contracts;

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

	/**
	 * TODO: change result to MultiCurve once we have it.
	 */
	public function boundary(): Contracts\Geometry // MultiCurve
	{
		return $this->geometryFromMethod('ST_Boundary', $this);
	}
}
