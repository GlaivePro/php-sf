<?php

namespace Janaseta\SF\SpatiaLite;

use Janaseta\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with SpatiaLite-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \Janaseta\SF\OGC\Traits\Point;
}
