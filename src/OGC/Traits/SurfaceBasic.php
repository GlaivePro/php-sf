<?php

namespace GlaivePro\SF\OGC\Traits;

use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts;

/**
 * Returns SQL statements common to
 * Table 13 — SQL functions on type Surface
 * Table 17 — SQL functions on type MultiSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
trait SurfaceBasic
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
