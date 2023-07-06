<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with PostGIS-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \GlaivePro\SF\OGC\Traits\Point;
}
