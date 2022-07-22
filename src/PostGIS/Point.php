<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with PostGIS-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \Janaseta\SF\OGC\Traits\Point;
}
