<?php

namespace TontonsB\SF\SpatiaLite;

use TontonsB\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with SpatiaLite-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \TontonsB\SF\OGC\Traits\Point;
}
