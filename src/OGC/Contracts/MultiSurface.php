<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.13 MultiSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface MultiSurface extends GeometryCollection
{
	public function area(): Expression; // Area(float)-valued expression
	public function centroid(): Point;
	public function pointOnSurface(): Point;
}
