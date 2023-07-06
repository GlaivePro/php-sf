<?php

namespace GlaivePro\SF\PostGIS;

use GlaivePro\SF\OGC\Contracts\MultiLineString as OGCMultiLineString;

/**
 * MultiLineString model with PostGIS-specific functions.
 */
class MultiLineString extends MultiCurve implements OGCMultiLineString {}
