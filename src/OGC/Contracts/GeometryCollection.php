<?php

namespace GlaivePro\SF\OGC\Contracts;

use GlaivePro\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.3 GeometryCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface GeometryCollection extends Geometry
{
	public function numGeometries(): Expression; // Integer-valued expression
	public function geometryN(int|Expression $n): Geometry;
}
