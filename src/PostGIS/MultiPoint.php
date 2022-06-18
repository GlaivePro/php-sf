<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\MultiPoint as OGCMultiPoint;

/**
 * MultiPoint model with PostGIS-specific functions.
 */
class MultiPoint extends GeometryCollection implements OGCMultiPoint {}
