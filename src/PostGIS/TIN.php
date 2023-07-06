<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\TIN as OGCTIN;

/**
 * TIN model with PostGIS-specific functions.
 */
class TIN extends PolyhedralSurface implements OGCTIN {}
