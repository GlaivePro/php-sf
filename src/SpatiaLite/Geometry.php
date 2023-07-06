<?php

namespace GlaivePro\SF\SpatiaLite;

use GlaivePro\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with SpatiaLite-specific functions.
 */
class Geometry extends OGCGeometry
{
	public function setSRID(int $srid): static
	{
		return static::fromMethod('SetSRID', $this, $srid);
	}
}
