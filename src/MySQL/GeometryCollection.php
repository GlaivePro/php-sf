<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\OGC\Contracts\GeometryCollection as OGCGeometryCollection;

/**
 * GeometryCollection model with MySQL-specific functions.
 */
class GeometryCollection extends Geometry implements OGCGeometryCollection
{
	use \GlaivePro\SF\OGC\Traits\GeometryCollection;
}
