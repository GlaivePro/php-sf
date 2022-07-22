<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\Curve as OGCCurve;

/**
 * Curve model with PostGIS-specific functions.
 */
class Curve extends Geometry implements OGCCurve
{
	use \Janaseta\SF\OGC\Traits\Curve;
}
