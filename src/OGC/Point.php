<?php

namespace GlaivePro\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.4 Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.9 SQL routines on type Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 */
class Point extends Geometry implements Contracts\Point
{
	use Traits\Point;
}
