<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\OGC\Contracts\MultiSurface as OGCMultiSurface;

/**
 * MultiSurface model with MySQL-specific functions.
 */
class MultiSurface extends GeometryCollection implements OGCMultiSurface
{
	use \GlaivePro\SF\OGC\Traits\SurfaceBasic;

	public function pointOnSurface(): \GlaivePro\SF\OGC\Contracts\Point
	{
		throw new MethodNotImplemented;
	}
}
