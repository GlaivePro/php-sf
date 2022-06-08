<?php

namespace TontonsB\SF\SpatiaLite;

use TontonsB\SF\Geometry as OGCGeometry;

/**
 * Geometry model with SpatiaLite-specific functions.
 */
class Geometry extends OGCGeometry
{
	use GeometryFunctions;
}
