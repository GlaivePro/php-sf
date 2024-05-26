<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\LineString as OGCLineString;

/**
 * LineString model with MariaDB-specific functions.
 */
class LineString extends Curve implements OGCLineString
{
	use \GlaivePro\SF\OGC\Traits\LineString;
}
