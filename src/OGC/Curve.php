<?php

namespace Janaseta\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.10 SQL routines on type Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 */
class Curve extends Geometry implements Contracts\Curve
{
	use Traits\Curve;
}
