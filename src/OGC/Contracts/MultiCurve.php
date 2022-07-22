<?php

namespace Janaseta\SF\OGC\Contracts;

use Janaseta\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.8 MultiCurve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface MultiCurve extends GeometryCollection
{
	public function isClosed(): Expression; // Boolean-valued expression
	public function length(): Expression; // Distance(float)-valued expression
}
