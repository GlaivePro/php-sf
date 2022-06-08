<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 */
interface Curve extends Geometry
{
	public function length(): Expression; // Float-valued expression
	public function startPoint(): Point;
	public function endPoint(): Point;
	public function isClosed(): Expression; // Boolean-valued expression
	public function isRing(): Expression; // Boolean-valued expression
}
