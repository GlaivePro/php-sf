<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\Polygon as OGCPolygon;

/**
 * Polygon model with PostGIS-specific functions.
 */
class Polygon extends Surface implements OGCPolygon
{
	use \GlaivePro\SF\OGC\Traits\Polygon;
}
