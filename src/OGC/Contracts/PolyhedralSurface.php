<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.12 PolyhedralSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * // TODO also implement MultiPolygon's routines.
 *
 * According to Part 1: Common architecture:
 * > A Polyhedral Surface is not a MultiPolygon because it violates the rule
 * > for MultiPolygons that the boundaries of the element Polygons intersect
 * > only at a finite number of Points.
 * but according to Part 2: SQL option:
 * > The routines supported by type Geometry, Surface and MultiPolygon shall
 * > be supported for geometries of type Polyhedral Surface, PolyhedSurface.
 */
interface PolyhedralSurface extends Surface
{
	public function numPatches(): Expression; // Integer-valued expression
	public function patchN(int|Expression $n): Polygon;
	public function boundingPolygons(Polygon $p): Geometry; // MultiPolygon
	public function isClosed(): Expression; // Boolean-valued expression
}
