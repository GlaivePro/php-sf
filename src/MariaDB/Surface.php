<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\Surface as OGCSurface;

/**
 * Surface model with MariaDB-specific functions.
 */
class Surface extends Geometry implements OGCSurface
{
	use \GlaivePro\SF\OGC\Traits\Surface;
}
