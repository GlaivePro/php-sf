<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\OGC\Contracts\Polygon as OGCPolygon;

/**
 * Polygon model with MySQL-specific functions.
 */
class Polygon extends Surface implements OGCPolygon
{
	use \GlaivePro\SF\OGC\Traits\Polygon;
}
