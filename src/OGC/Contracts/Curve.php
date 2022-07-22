<?php

namespace Janaseta\SF\OGC\Contracts;

use Janaseta\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface Curve extends Geometry
{
	public function length(): Expression; // Float-valued expression // or length
	public function startPoint(): Point;
	public function endPoint(): Point;
	public function isClosed(): Expression; // Boolean-valued expression
	public function isRing(): Expression; // Boolean-valued expression
}
