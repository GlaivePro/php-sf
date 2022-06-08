<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\LineString as OGCLinearRing;

/**
 * LinearRing model with PostGIS-specific functions.
 */
class LinearRing extends LineString implements OGCLinearRing {}
