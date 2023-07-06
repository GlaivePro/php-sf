<?php

namespace GlaivePro\SF\SpatiaLite;

use GlaivePro\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with SpatiaLite-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \GlaivePro\SF\OGC\Traits\Point;
}
