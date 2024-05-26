<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\MultiLineString as OGCMultiLineString;

/**
 * MultiLineString model with MariaDB-specific functions.
 */
class MultiLineString extends MultiCurve implements OGCMultiLineString {}
