<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\Polygon as OGCPolygon;

/**
 * Polygon model with PostGIS-specific functions.
 */
class Polygon extends Surface implements OGCPolygon
{
	use \Janaseta\SF\OGC\Traits\Polygon;
}
