<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.4 Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 */
interface Point extends Geometry
{
	public function X(): Expression; // Float-valued expression
	public function Y(): Expression; // Float-valued expression
	public function Z(): Expression; // Float-valued expression
	public function M(): Expression; // Float-valued expression
}
