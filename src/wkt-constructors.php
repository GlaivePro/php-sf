<?php

namespace TontonsB\SF;

/**
 * Implements constructors according to
 * Table 3 — SQL functions for constructing a geometric object given its
 * Well-known Text Representation
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 2: SQL option"
 */

// TODO: consider adding Table 4 — Optional SQL functions for constructing a
// geometric object given its Well-known Text Representation

/**
 * Create a Geometry from WKT.
 *
 * If SRID is omitted, we will also omit it.
 */
function geomFromText(string $geometryTaggedText, int $SRID = null): Geometry
{
	return is_null($SRID)
		? Geometry::fromMethod('ST_GeomFromText', $geometryTaggedText)
		: Geometry::fromMethod('ST_GeomFromText', $geometryTaggedText, $SRID);
}

/**
 * Create a Point from WKT.
 *
 * If SRID is omitted, we will also omit it.
 */
function pointFromText(string $pointTaggedText, int $SRID = null): Point
{
	return is_null($SRID)
		? Point::fromMethod('ST_PointFromText', $pointTaggedText)
		: Point::fromMethod('ST_PointFromText', $pointTaggedText, $SRID);
}

// TODO: lineFromText
// TODO: polyFromText
// TODO: mPointFromText
// TODO: mLineFromText
// TODO: mPolyFromText

/**
 * Create a GeometryCollection from WKT.
 *
 * If SRID is omitted, we will also omit it.
 */
function geomCollFromText(string $geometryCollectionTaggedText, int $SRID = null): GeometryCollection
{
	return is_null($SRID)
		? GeometryCollection::fromMethod('ST_GeomCollFromText', $geometryCollectionTaggedText)
		: GeometryCollection::fromMethod('ST_GeomCollFromText', $geometryCollectionTaggedText, $SRID);
}
