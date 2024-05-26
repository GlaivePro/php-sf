<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\MultiSurface as OGCMultiSurface;

/**
 * MultiSurface model with MariaDB-specific functions.
 */
class MultiSurface extends GeometryCollection implements OGCMultiSurface
{
	use \GlaivePro\SF\OGC\Traits\SurfaceBasic;
}
