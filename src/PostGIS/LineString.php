<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\LineString as OGCLineString;

/**
 * LineString model with PostGIS-specific functions.
 */
class LineString extends Curve implements OGCLineString
{
	use \Janaseta\SF\OGC\Traits\LineString;
}
