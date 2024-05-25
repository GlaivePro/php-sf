<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\OGC\Contracts\Surface as OGCSurface;

/**
 * Surface model with MySQL-specific functions.
 */
class Surface extends Geometry implements OGCSurface
{
	use \GlaivePro\SF\OGC\Traits\Surface;

	public function pointOnSurface(): \GlaivePro\SF\OGC\Contracts\Point
	{
		throw new MethodNotImplemented;
	}
}
