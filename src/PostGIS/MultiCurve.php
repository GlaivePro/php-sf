<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\MultiCurve as OGCMultiCurve;

/**
 * MultiCurve model with PostGIS-specific functions.
 */
class MultiCurve extends GeometryCollection implements OGCMultiCurve
{
	use \Janaseta\SF\OGC\Traits\CurveBasic;
}
