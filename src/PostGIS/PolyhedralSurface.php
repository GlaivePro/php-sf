<?php

namespace Janaseta\SF\PostGIS;

use Janaseta\SF\Expression;
use Janaseta\SF\OGC\Contracts\PolyhedralSurface as OGCPolyhedralSurface;

/**
 * PolyhedralSurface model with PostGIS-specific functions.
 */
class PolyhedralSurface extends Surface implements OGCPolyhedralSurface
{
	use \Janaseta\SF\OGC\Traits\GeometryCollection;
	use \Janaseta\SF\OGC\Traits\PolyhedralSurface;

	public function numPatches(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_NumPatches');
	}

	public function patchN(int|Expression $n): Polygon
	{
		// We are explicitly NOT wrapping $n in an Expression, because
		// raw numeric values should go to bindings.
		return $this->polygonFromMethod(
			'ST_PatchN',
			$this,
			$n,
		);
	}

	public function isClosed(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsClosed');
	}
}
