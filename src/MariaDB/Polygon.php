<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts\Polygon as OGCPolygon;

/**
 * Polygon model with MariaDB-specific functions.
 */
class Polygon extends Surface implements OGCPolygon
{
	use \GlaivePro\SF\OGC\Traits\Polygon;

	public function numInteriorRing(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumInteriorRings');
	}
}
