<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts\Curve as OGCCurve;

/**
 * Curve model with MySQL-specific functions.
 */
class Curve extends Geometry implements OGCCurve
{
	use \GlaivePro\SF\OGC\Traits\Curve;

	public function isRing(): Expression // Boolean-valued expression
	{
		throw new MethodNotImplemented;
	}
}
