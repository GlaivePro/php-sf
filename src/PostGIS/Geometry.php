<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with PostGIS-specific functions.
 */
class Geometry extends OGCGeometry
{
	public function setSRID(int $srid): static
	{
		return static::fromMethod('ST_SetSRID', $this, $srid);
	}
}
