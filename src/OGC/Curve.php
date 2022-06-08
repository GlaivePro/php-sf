<?php

namespace TontonsB\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.6 Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 11 — SQL functions on type Curve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class Curve extends Geometry implements Contracts\Curve
{
	use Traits\Curve;
}
