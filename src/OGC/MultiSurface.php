<?php

namespace TontonsB\SF\OGC;

/**
 * Defines geometry model according to
 * 6.1.13 MultiSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 17 — SQL functions on type MultiSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
class MultiSurface extends GeometryCollection implements Contracts\MultiSurface
{
	use Traits\MultiSurface;
}
