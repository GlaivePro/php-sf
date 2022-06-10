<?php

namespace TontonsB\SF\OGC;

/**
 * Implements geometry model according to
 * 6.1.12 PolyhedralSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.14 SQL functions on type Polyhedral Surface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 *
 * // TODO: add the MultiPolygon routines
 */
class PolyhedralSurface extends Surface implements Contracts\PolyhedralSurface
{
	use Traits\PolyhedralSurface;
}
