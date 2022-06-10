<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\TIN as OGCTIN;

/**
 * TIN model with PostGIS-specific functions.
 */
class TIN extends PolyhedralSurface implements OGCTIN {}
