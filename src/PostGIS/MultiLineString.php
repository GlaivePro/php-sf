<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\OGC\Contracts\MultiLineString as OGCMultiLineString;

/**
 * MultiLineString model with PostGIS-specific functions.
 */
class MultiLineString extends MultiCurve implements OGCMultiLineString {}
