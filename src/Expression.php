<?php

namespace GlaivePro\SF;

use Closure;

class Expression implements \Stringable
{
	protected static ?Closure $quoter = null;

	public function __construct(
		public readonly string $sql,
		public readonly array $bindings = [],
	) {}

	public function __toString(): string
	{
		return $this->sql;
	}

	/**
	 * Ensures $expression is an instance of static. If it's not possible, i.e.
	 * it's an instance of another class, throws exception.
	 */
	public static function make(string|self $expression): static
	{
		if ($expression instanceof static)
			return $expression;

		if (\is_string($expression))
			return new static($expression);

		throw new Exceptions\InvalidExpressionType(
			'Only strings and '.static::class.' can be wrapped in expressions of type '.static::class.'.'
		);
	}

	/**
	 * Creates a new instance of static that calls $method and supplies $args.
	 * Any Expression args are merged in the sql expression while raw args
	 * are moved to bindings and replaced by ?.
	 */
	public static function fromMethod(string $method, int|float|string|bool|self ...$args): static
	{
		$params = [];
		$bindings = [];

		foreach ($args as $arg) {
			if ($arg instanceof self) {
				// Expressions are added to method params as is and
				// their bindings are appended to the binding array.
				$params[] = $arg;

				$bindings = [
					...$bindings,
					...$arg->bindings,
				];
			} elseif (static::quotes()) {
				// In quoting mode raw args are quoted and used as params
				$params[] = static::quote($arg);
			} else {
				// In bindings mode raw arguments are replaced by ? and moved to bindings.
				$params[] = '?';
				$bindings[] = $arg;
			}
		}

		$params = implode(', ', $params);

		return new static("$method($params)", $bindings);
	}

	protected static function quote($value)
	{
		return (static::$quoter)($value);
	}

	protected static function quotes(): bool
	{
		return (bool) static::$quoter;
	}

	public static function setQuoter(?Closure $quoter): void
	{
		static::$quoter = $quoter;
	}
}
