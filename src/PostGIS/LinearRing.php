<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\LineString as OGCLinearRing;

/**
 * LinearRing model with PostGIS-specific functions.
 */
class LinearRing extends LineString implements OGCLinearRing {}
