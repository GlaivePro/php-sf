<?php

namespace TontonsB\SF;

/**
 * Implements geometry model according to
 * 6.1.3 Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * Returns SQL statements according to
 * Table 10 — SQL functions on type Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */
class Point extends Geometry
{
	public function X(): Expression // Float-valued expression
	{
		return $this->wrap('ST_X');
	}

	public function Y(): Expression // Float-valued expression
	{
		return $this->wrap('ST_Y');
	}

	public function Z(): Expression // Float-valued expression
	{
		return $this->wrap('ST_Z');
	}

	public function M(): Expression // Float-valued expression
	{
		return $this->wrap('ST_M');
	}
}
