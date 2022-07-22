<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\GeometryCollection as OGCGeometryCollection;

/**
 * GeometryCollection model with PostGIS-specific functions.
 */
class GeometryCollection extends Geometry implements OGCGeometryCollection
{
	use \Janaseta\SF\OGC\Traits\GeometryCollection;
}
