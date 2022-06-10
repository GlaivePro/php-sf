<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\Polygon as OGCPolygon;

/**
 * Polygon model with PostGIS-specific functions.
 */
class Polygon extends Surface implements OGCPolygon
{
	use \TontonsB\SF\OGC\Traits\Polygon;
}
