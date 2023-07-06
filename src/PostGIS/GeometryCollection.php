<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\GeometryCollection as OGCGeometryCollection;

/**
 * GeometryCollection model with PostGIS-specific functions.
 */
class GeometryCollection extends Geometry implements OGCGeometryCollection
{
	use \GlaivePro\SF\OGC\Traits\GeometryCollection;
}
