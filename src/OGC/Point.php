<?php

namespace TontonsB\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.4 Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 10 — SQL functions on type Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class Point extends Geometry implements Contracts\Point
{
	use Traits\Point;
}
