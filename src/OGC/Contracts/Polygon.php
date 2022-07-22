<?php

namespace Janaseta\SF\OGC\Contracts;

use Janaseta\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.11 Polygon, Triangle
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface Polygon extends Surface
{
	public function exteriorRing(): LineString;
	public function numInteriorRing(): Expression; // Integer-valued expression
	public function interiorRingN(int|Expression $n): LineString;
}
