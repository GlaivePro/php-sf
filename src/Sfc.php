<?php

namespace GlaivePro\SF;

use GlaivePro\SF\OGC\Sfc as OGCSfc;

/**
 * Simple feature constructors for the selected driver.
 */
class Sfc
{
	protected OGCSfc $driver;

	public function __construct(string $driver = 'OGC')
	{
		$driverClass = '\\GlaivePro\\SF\\'.$driver.'\\Sfc';

		$this->driver = new $driverClass;
	}

	public function __call($method, $args)
	{
		return $this->driver->$method(...$args);
	}
}
