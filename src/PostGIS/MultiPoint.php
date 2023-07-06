<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\MultiPoint as OGCMultiPoint;

/**
 * MultiPoint model with PostGIS-specific functions.
 */
class MultiPoint extends GeometryCollection implements OGCMultiPoint {}
