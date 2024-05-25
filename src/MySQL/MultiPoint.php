<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\OGC\Contracts\MultiPoint as OGCMultiPoint;

/**
 * MultiPoint model with MySQL-specific functions.
 */
class MultiPoint extends GeometryCollection implements OGCMultiPoint {}
