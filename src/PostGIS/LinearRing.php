<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\LineString as OGCLinearRing;

/**
 * LinearRing model with PostGIS-specific functions.
 */
class LinearRing extends LineString implements OGCLinearRing {}
