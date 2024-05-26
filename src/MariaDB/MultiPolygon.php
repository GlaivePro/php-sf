<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\OGC\Contracts\MultiPolygon as OGCMultiPolygon;

/**
 * MultiPolygon model with MariaDB-specific functions.
 */
class MultiPolygon extends MultiSurface implements OGCMultiPolygon {}
