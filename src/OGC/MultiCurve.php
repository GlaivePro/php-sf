<?php

namespace GlaivePro\SF\OGC;

/**
 * Defines geometry model according to
 * 6.1.8 MultiCurve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * Table 16 — SQL functions on type MultiCurve
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.1.0
 */
class MultiCurve extends GeometryCollection implements Contracts\MultiCurve
{
	use Traits\CurveBasic;
}
