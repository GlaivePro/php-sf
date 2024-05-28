<?php

namespace GlaivePro\SF;

/**
 * Creating simple feature classes of the selected driver.
 */
class Sf
{
	protected string $namespace;

	public function __construct(string $driver = 'OGC')
	{
		$this->namespace = '\\GlaivePro\\SF\\'.$driver.'\\';
	}

	public function __call($method, $args)
	{
		$class = $this->namespace.ucfirst($method);

		return new $class(...$args);
	}
}
