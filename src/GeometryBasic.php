<?php

namespace TontonsB\SF;

/**
 * Supports basic methods on geometry object according to
 * 6.1.2.2 Basic methods on geometric objects
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture"
 */
trait GeometryBasic
{
	public function dimension(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_Dimension');
	}

	public function coordinateDimension(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_CoordDim');
	}

	/**
	 * Alias for coordinateDimension as used in PostGIS
	 */
	public function coordDim(): Expression // Integer-valued expression
	{
		return $this->coordinateDimension();
	}

	/**
	 * Alias for coordinateDimension as used in PostGIS
	 */
	public function nDims(): Expression // Integer-valued expression
	{
		return $this->coordinateDimension();
	}

	/**
	 * This is defined in SFA part 1, but not mentioned in SFA part 2.
	 *
	 * TODO: Find out what this is supposed to do :)
	 */
	public function spatialDimension(): Expression // Integer-valued expression
	{
		throw new Exceptions\MethodNotImplemented;
	}

	public function geometryType(): Expression // String-valued expression
	{
		return $this->wrap('ST_GeometryType');
	}

	public function SRID(): Expression // Integer-valued expression
	{
		return $this->wrap('ST_SRID');
	}

	public function envelope(): Geometry
	{
		return Geometry::fromMethod('ST_Envelope', $this);
	}

	// TODO: This should optionally accept maxdecimaldigits parameter
	public function asText(): Expression // String-valued expression
	{
		return $this->wrap('ST_AsText');
	}

	// TODO: This should optionally accept NDR_or_XDR parameter
	public function asBinary(): Expression // Binary-valued expression
	{
		return $this->wrap('ST_AsBinary');
	}

	public function isEmpty(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsEmpty');
	}

	public function isSimple(): Expression // Boolean-valued expression
	{
		return $this->wrap('ST_IsSimple');
	}

	/**
	 * This is defined in SFA part 1, but not mentioned in SFA part 2.
	 *
	 * See https://trac.osgeo.org/postgis/ticket/1433 as PostGIS
	 * considers this redundant, unused and moved to PostGIS legacy.
	 */
	public function is3D(): Expression // Boolean-valued expression
	{
		return $this->wrap('SE_Is3D');
	}

	/**
	 * This is defined in SFA part 1, but not mentioned in SFA part 2.
	 *
	 * See https://trac.osgeo.org/postgis/ticket/1433 as PostGIS
	 * considers this redundant, unused and moved to PostGIS legacy.
	 */
	public function isMeasured(): Expression // Boolean-valued expression
	{
		return $this->wrap('SE_IsMeasured');
	}

	public function boundary(): Geometry
	{
		return Geometry::fromMethod('ST_Boundary', $this);
	}
}