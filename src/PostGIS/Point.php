<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\Point as OGCPoint;

/**
 * Point model with PostGIS-specific functions.
 */
class Point extends Geometry implements OGCPoint
{
	use \TontonsB\SF\OGC\Traits\Point;
}
