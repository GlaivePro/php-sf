<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\Triangle as OGCTriangle;

/**
 * Triangle model with PostGIS-specific functions.
 */
class Triangle extends Polygon implements OGCTriangle {}
