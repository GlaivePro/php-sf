<?php

namespace TontonsB\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.11 Polygon, Triangle
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 14 — SQL functions on type Polygon
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class Polygon extends Surface implements Contracts\Polygon
{
	use Traits\Polygon;
}
