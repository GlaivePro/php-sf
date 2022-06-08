<?php

namespace TontonsB\SF\PostGIS;

/**
 * Geometry functions specific to PostGIS.
 *
 * See https://postgis.net/docs/reference.html
 */
trait GeometryFunctions
{
	public function setSRID(int $srid): static
	{
		return static::fromMethod('ST_SetSRID', $this, $srid);
	}
}
