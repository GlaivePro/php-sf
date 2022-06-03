<?php

namespace TontonsB\SF;

/**
 * Implements geometry model according to
 * 6.1.10 Surface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 */
class Surface extends Geometry
{
	public function area(): Expression // Area(float)-valued expression
	{
		return $this->wrap('ST_Area');
	}

	public function centroid(): Point
	{
		return Point::fromMethod('ST_Centroid', $this);
	}

	public function pointOnSurface(): Point
	{
		return Point::fromMethod('ST_PointOnSurface', $this);
	}

	/**
	 * TODO: change result to MultiCurve once we have it.
	 */
	public function boundary(): Geometry // MultiCurve
	{
		return Geometry::fromMethod('ST_Boundary', $this);
	}
}
