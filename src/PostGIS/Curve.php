<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\Curve as OGCCurve;

/**
 * Curve model with PostGIS-specific functions.
 */
class Curve extends Geometry implements OGCCurve
{
	use \TontonsB\SF\OGC\Traits\Curve;
}
