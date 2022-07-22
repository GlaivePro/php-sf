<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\Surface as OGCSurface;

/**
 * Surface model with PostGIS-specific functions.
 */
class Surface extends Geometry implements OGCSurface
{
	use \Janaseta\SF\OGC\Traits\Surface;
}
