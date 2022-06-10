<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\Triangle as OGCTriangle;

/**
 * Triangle model with PostGIS-specific functions.
 */
class Triangle extends Polygon implements OGCTriangle {}
