<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\MultiSurface as OGCMultiSurface;

/**
 * MultiSurface model with PostGIS-specific functions.
 */
class MultiSurface extends GeometryCollection implements OGCMultiSurface
{
	use \Janaseta\SF\OGC\Traits\SurfaceBasic;
}
