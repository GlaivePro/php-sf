<?php

namespace TontonsB\SF;

/**
 * Implements geometry model according to
 * 6.1.3 Point
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
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
