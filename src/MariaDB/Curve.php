<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\Curve as OGCCurve;

/**
 * Curve model with MariaDB-specific functions.
 */
class Curve extends Geometry implements OGCCurve
{
	use \GlaivePro\SF\OGC\Traits\Curve;
}
