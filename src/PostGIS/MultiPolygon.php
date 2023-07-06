<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\MultiPolygon as OGCMultiPolygon;

/**
 * MultiPolygon model with PostGIS-specific functions.
 */
class MultiPolygon extends MultiSurface implements OGCMultiPolygon {}
