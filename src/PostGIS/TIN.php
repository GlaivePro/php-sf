<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\TIN as OGCTIN;

/**
 * TIN model with PostGIS-specific functions.
 */
class TIN extends PolyhedralSurface implements OGCTIN {}
