<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\GeometryCollection as OGCGeometryCollection;

/**
 * GeometryCollection model with MariaDB-specific functions.
 */
class GeometryCollection extends Geometry implements OGCGeometryCollection
{
	use \GlaivePro\SF\OGC\Traits\GeometryCollection;
}
