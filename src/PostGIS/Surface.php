<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\Surface as OGCSurface;

/**
 * Surface model with PostGIS-specific functions.
 */
class Surface extends Geometry implements OGCSurface
{
	use \GlaivePro\SF\OGC\Traits\Surface;
}
