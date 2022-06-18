<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\MultiSurface as OGCMultiSurface;

/**
 * MultiSurface model with PostGIS-specific functions.
 */
class MultiSurface extends GeometryCollection implements OGCMultiSurface
{
	use \TontonsB\SF\OGC\Traits\SurfaceBasic;
}
