<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\GeometryCollection as OGCGeometryCollection;

/**
 * GeometryCollection model with PostGIS-specific functions.
 */
class GeometryCollection extends Geometry implements OGCGeometryCollection
{
	use \TontonsB\SF\OGC\Traits\GeometryCollection;
}
