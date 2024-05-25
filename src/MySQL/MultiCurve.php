<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\OGC\Contracts\MultiCurve as OGCMultiCurve;

/**
 * MultiCurve model with MySQL-specific functions.
 */
class MultiCurve extends GeometryCollection implements OGCMultiCurve
{
	use \GlaivePro\SF\OGC\Traits\CurveBasic;
}
