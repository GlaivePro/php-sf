<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Contracts\MultiLineString as OGCMultiLineString;

/**
 * MultiLineString model with PostGIS-specific functions.
 */
class MultiLineString extends MultiCurve implements OGCMultiLineString {}
