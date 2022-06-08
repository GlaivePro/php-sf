<?php

namespace TontonsB\SF\SpatiaLite;

/**
 * Geometry functions specific to SpatiaLite.
 *
 * See https://www.gaia-gis.it/gaia-sins/spatialite-sql-5.0.1.html
 */
trait GeometryFunctions
{
	public function setSRID(int $srid): static
	{
		return static::fromMethod('SetSRID', $this, $srid);
	}
}
