<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\MultiCurve as OGCMultiCurve;

/**
 * MultiCurve model with PostGIS-specific functions.
 */
class MultiCurve extends GeometryCollection implements OGCMultiCurve
{
	use \GlaivePro\SF\OGC\Traits\CurveBasic;
}
