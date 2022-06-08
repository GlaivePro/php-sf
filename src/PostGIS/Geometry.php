<?php

namespace TontonsB\SF\PostGIS;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with PostGIS-specific functions.
 */
class Geometry extends OGCGeometry
{
	protected const sfc = Sfc::class;

	public function setSRID(int $srid): static
	{
		return static::fromMethod('ST_SetSRID', $this, $srid);
	}

	/**
	 * Alias for coordinateDimension
	 */
	public function coordDim(): Expression // Integer-valued expression
	{
		return $this->coordinateDimension();
	}

	/**
	 * Alias for coordinateDimension
	 */
	public function nDims(): Expression // Integer-valued expression
	{
		return $this->coordinateDimension();
	}
}
