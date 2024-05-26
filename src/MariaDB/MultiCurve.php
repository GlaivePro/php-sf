<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\MultiCurve as OGCMultiCurve;

/**
 * MultiCurve model with MariaDB-specific functions.
 */
class MultiCurve extends GeometryCollection implements OGCMultiCurve
{
	use \GlaivePro\SF\OGC\Traits\CurveBasic;
}
