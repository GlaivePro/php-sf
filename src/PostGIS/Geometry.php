<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with PostGIS-specific functions.
 */
class Geometry extends OGCGeometry
{
	use GeometryFunctions;
}
