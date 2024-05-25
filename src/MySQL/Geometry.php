<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with MySQL-specific functions.
 */
class Geometry extends OGCGeometry
{
	protected const sfc = Sfc::class;

	public function setSRID(int $srid): static
	{
		return static::fromMethod('ST_SRID', $this, $srid);
	}

	public function coordinateDimension(): Expression // Integer-valued expression
	{
		throw new MethodNotImplemented;
	}

	public function is3D(): Expression // Boolean-valued expression
	{
		throw new MethodNotImplemented;
	}

	public function isMeasured(): Expression // Boolean-valued expression
	{
		throw new MethodNotImplemented;
	}

	public function boundary(): \GlaivePro\SF\OGC\Contracts\Geometry
	{
		throw new MethodNotImplemented;
	}
}
