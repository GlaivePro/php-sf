<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\OGC\Contracts\LineString as OGCLineString;

/**
 * LineString model with MySQL-specific functions.
 */
class LineString extends Curve implements OGCLineString
{
	use \GlaivePro\SF\OGC\Traits\LineString;
}
