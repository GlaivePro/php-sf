<?php

namespace TontonsB\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.3 GeometryCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 15 — SQL functions on type GeomCollection
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class GeometryCollection extends Geometry implements Contracts\GeometryCollection
{
	use Traits\GeometryCollection;
}
