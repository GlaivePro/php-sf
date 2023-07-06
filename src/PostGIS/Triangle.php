<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\Triangle as OGCTriangle;

/**
 * Triangle model with PostGIS-specific functions.
 */
class Triangle extends Polygon implements OGCTriangle {}
