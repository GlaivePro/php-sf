<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\MultiPoint as OGCMultiPoint;

/**
 * MultiPoint model with PostGIS-specific functions.
 */
class MultiPoint extends GeometryCollection implements OGCMultiPoint {}
