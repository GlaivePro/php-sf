<?php

namespace Janaseta\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.7 LineString, Line, LinearRing
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.11 SQL routines on type LineString
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 */
class LineString extends Curve implements Contracts\LineString
{
	use Traits\LineString;
}
