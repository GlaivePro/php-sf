<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Point as OGCPoint;

/**
 * Point model with PostGIS-specific functions.
 */
class Point extends OGCPoint
{
	use GeometryFunctions;
}
