<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with MariaDB-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \GlaivePro\SF\OGC\Traits\Point;

	public function Z(): Expression
	{
		throw new MethodNotImplemented;
	}

	public function M(): Expression
	{
		throw new MethodNotImplemented;
	}
}
