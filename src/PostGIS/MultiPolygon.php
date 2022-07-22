<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\MultiPolygon as OGCMultiPolygon;

/**
 * MultiPolygon model with PostGIS-specific functions.
 */
class MultiPolygon extends MultiSurface implements OGCMultiPolygon {}
