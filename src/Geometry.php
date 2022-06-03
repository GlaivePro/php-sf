<?php

namespace TontonsB\SF;

/**
 * Implements geometry model according to
 * 6.1 Geometry object model
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 *
 * The method and argument names follow the spec. Exceptions are some methods
 * and args that are not present in the spec, but implemented in PostGIS.
 *
 * TODO: Implement return types according to spec. Or PostGIS. Or both.
 */
class Geometry extends Expression
{
	use GeometryAnalysis;
	use GeometryBasic;
	use GeometryQuery;

	/**
	 * Helper for simple expression creation that calls $method on $this.
	 *
	 * TODO: reconsider viability if/when more detailed Expression types are
	 * introduced.
	 */
	protected function wrap(string $method): Expression
	{
		return Expression::fromMethod($method, $this);
	}

	/**
	 * Helper for simple expression creation that queries $this against
	 * $another Geometry using $method.
	 *
	 * TODO: reconsider viability if/when more detailed Expression types are
	 * introduced.
	 */
	protected function query(string $method, self|string $another): Expression
	{
		return Expression::fromMethod(
			$method,
			$this,
			self::make($another),
		);
	}

	/**
	 * Helper for geometry creation from $this and $another Geometry using $method.
	 */
	protected function combine(string $method, self|string $another): self
	{
		return self::fromMethod(
			$method,
			$this,
			self::make($another),
		);
	}
}
