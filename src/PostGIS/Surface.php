<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\Surface as OGCSurface;

/**
 * Surface model with PostGIS-specific functions.
 */
class Surface extends Geometry implements OGCSurface
{
	use \TontonsB\SF\OGC\Traits\Surface;
}
