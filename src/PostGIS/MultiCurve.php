<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\MultiCurve as OGCMultiCurve;

/**
 * MultiCurve model with PostGIS-specific functions.
 */
class MultiCurve extends GeometryCollection implements OGCMultiCurve
{
	use \TontonsB\SF\OGC\Traits\CurveBasic;
}
