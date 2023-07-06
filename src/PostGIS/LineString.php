<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\LineString as OGCLineString;

/**
 * LineString model with PostGIS-specific functions.
 */
class LineString extends Curve implements OGCLineString
{
	use \GlaivePro\SF\OGC\Traits\LineString;
}
