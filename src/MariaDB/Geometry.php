<?php

namespace GlaivePro\SF\MariaDB;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Contracts\Geometry as GeometryInterface;
use GlaivePro\SF\OGC\Geometry as OGCGeometry;

/**
 * Geometry model with MariaDB-specific functions.
 */
class Geometry extends OGCGeometry
{
	protected const sfc = Sfc::class;

	/**
	 * There is no native SetSRID in MariaDB, but it's important enough to support it.
	 */
	public function setSRID(int $srid): static
	{
		return static::fromMethod(
			'ST_GeomFromWKB',
			static::fromMethod('ST_AsBinary', $this),
			$srid,
		);
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

	public function locateAlong(float $mValue): GeometryInterface
	{
		throw new MethodNotImplemented;
	}

	public function locateBetween(float $mStart, float $mEnd): GeometryInterface
	{
		throw new MethodNotImplemented;
	}
}
