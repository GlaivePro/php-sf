<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.10 Surface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 */
interface Surface extends Geometry
{
	public function area(): Expression; // Area(float)-valued expression
	public function centroid(): Point;
	public function pointOnSurface(): Point;
	public function boundary(): Geometry; // MultiCurve
}