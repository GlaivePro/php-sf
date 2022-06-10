<?php

namespace TontonsB\SF\OGC\Traits;

use TontonsB\SF\Exceptions\MethodNotImplemented;
use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Contracts;

/**
 * Implements geometry model according to
 * 6.1.12 PolyhedralSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Returns SQL statements according to
 * 7.2.14 SQL functions on type Polyhedral Surface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option" Version 1.2.1
 *
 * // TODO: Implement PostGIS-specific support for these.
 */
trait PolyhedralSurface
{
	public function numPatches(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumSurfaces');
	}

	public function patchN(int|Expression $n): Contracts\Polygon
	{
		// We are explicitly NOT wrapping $n in an Expression, because
		// raw numeric values should go to bindings.
		return $this->polygonFromMethod(
			'ST_Surface',
			$this,
			$n,
		);
	}

	public function boundingPolygons(Contracts\Polygon $p): Contracts\Geometry // MultiPolygon
	{
		// It appears that OpenGIS ® Implementation Standard for Geographic
		// information - Simple feature access - Part 1: Common architecture
		// defines this, but no implementation is described on
		// OpenGIS ® Implementation Standard for Geographic information - Simple
		// feature access - Part 2: SQL option (version 1.2.1 on both)
		throw new MethodNotImplemented;
	}

	public function isClosed(): Expression // Boolean-valued expression
	{
		// It appears that OpenGIS ® Implementation Standard for Geographic
		// information - Simple feature access - Part 1: Common architecture
		// defines this, but no implementation is described on
		// OpenGIS ® Implementation Standard for Geographic information - Simple
		// feature access - Part 2: SQL option (version 1.2.1 on both)
		throw new MethodNotImplemented;
	}
}
