<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\LineString as OGCLineString;

/**
 * LineString model with PostGIS-specific functions.
 */
class LineString extends Curve implements OGCLineString
{
	use \TontonsB\SF\OGC\Traits\LineString;
}
