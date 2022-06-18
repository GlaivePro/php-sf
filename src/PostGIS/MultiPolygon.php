<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\MultiPolygon as OGCMultiPolygon;

/**
 * MultiPolygon model with PostGIS-specific functions.
 */
class MultiPolygon extends MultiSurface implements OGCMultiPolygon {}
