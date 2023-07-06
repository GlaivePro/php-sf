<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\Curve as OGCCurve;

/**
 * Curve model with PostGIS-specific functions.
 */
class Curve extends Geometry implements OGCCurve
{
	use \GlaivePro\SF\OGC\Traits\Curve;
}
