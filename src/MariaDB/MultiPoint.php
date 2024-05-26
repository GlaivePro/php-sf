<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\MultiPoint as OGCMultiPoint;

/**
 * MultiPoint model with MariaDB-specific functions.
 */
class MultiPoint extends GeometryCollection implements OGCMultiPoint {}
