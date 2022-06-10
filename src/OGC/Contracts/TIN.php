<?php

namespace TontonsB\SF\OGC\Contracts;

use TontonsB\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.12 PolyhedralSurface
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * TIN (triangulated irregular network) = PolyhedralSurface made out of triangles
 */
interface TIN extends PolyhedralSurface {}
