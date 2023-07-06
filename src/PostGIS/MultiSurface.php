<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\MultiSurface as OGCMultiSurface;

/**
 * MultiSurface model with PostGIS-specific functions.
 */
class MultiSurface extends GeometryCollection implements OGCMultiSurface
{
	use \GlaivePro\SF\OGC\Traits\SurfaceBasic;
}
