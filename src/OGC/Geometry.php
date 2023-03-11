<?php

namespace Janaseta\SF\OGC;

use Janaseta\SF\Expression;

/**
 * Implements geometry model according to
 * 6.1.2 Geometry
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.8 SQL routines on type Geometry
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 *
 * TODO: Implement return types according to spec.
 */
class Geometry extends Expression implements Contracts\Geometry
{
	use Traits\GeometryAnalysis;
	use Traits\GeometryBasic;
	use Traits\GeometryQuery;

	protected const sfc = Sfc::class;

	public function __call($method, $args)
	{
		if (str_ends_with($method, 'FromMethod'))
			return static::sfc::$method(...$args);

		throw new \BadMethodCallException('Unknown static method '.static::class.'::'.$method.'.'); // @codeCoverageIgnore
	}

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
			// Workaround as `self::method()` is actually somewhat equal to `static::method()`
			// See https://stackoverflow.com/questions/75710102/is-self-actually-sometimes-late-in-php
			self::class::make($another),
		);
	}

	/**
	 * Helper for geometry creation from $this and $another Geometry using $method.
	 */
	protected function combine(string $method, self|string $another): self
	{
		return static::sfc::geometryFromMethod(
			$method,
			$this,
			// Workaround as `self::method()` is actually somewhat equal to `static::method()`
			// See https://stackoverflow.com/questions/75710102/is-self-actually-sometimes-late-in-php
			self::class::make($another),
		);
	}
}
