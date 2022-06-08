<?php

namespace TontonsB\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.7 LineString, Line, LinearRing
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 12 — SQL functions on type LineString
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class LineString extends Curve implements Contracts\LineString
{
	use Traits\LineString;
}
