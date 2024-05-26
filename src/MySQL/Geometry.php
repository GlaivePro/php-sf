<?php

namespace GlaivePro\SF\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts\Geometry as GeometryInterface;
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

	public function boundary(): GeometryInterface
	{
		throw new MethodNotImplemented;
	}

	public function relate(GeometryInterface|string $another, string $matrix): Expression // Boolean-valued expression
	{
		throw new MethodNotImplemented;
	}

	public function locateAlong(float $mValue): GeometryInterface
	{
		throw new MethodNotImplemented;
	}

	public function locateBetween(float $mStart, float $mEnd): GeometryInterface
	{
		throw new MethodNotImplemented;
	}
}
