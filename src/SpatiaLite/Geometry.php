<?php

namespace TontonsB\SF\SpatiaLite;

use TontonsB\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with SpatiaLite-specific functions.
 */
class Geometry extends OGCGeometry
{
	use GeometryFunctions;
}
