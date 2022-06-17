<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts;

/**
 * Defines geometry model according to
 * 6.1.13 MultiSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 17 — SQL functions on type MultiSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 *
 * TODO: reuse functions from Surface, extract into something like
 * GenericSurface or SurfaceBasic.
 */
trait MultiSurface
{
	public function area(): Expression // Area(float)-valued expression
	{
		return $this->wrap('ST_Area');
	}

	public function centroid(): Contracts\Point
	{
		return $this->pointFromMethod('ST_Centroid', $this);
	}

	public function pointOnSurface(): Contracts\Point
	{
		return $this->pointFromMethod('ST_PointOnSurface', $this);
	}
}
