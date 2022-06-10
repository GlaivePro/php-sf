<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.7 LineString, Line, LinearRing
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface LineString extends Curve
{
	public function numPoints(): Expression; // Integer-valued expression
	public function pointN(int|Expression $n): Point;
}
