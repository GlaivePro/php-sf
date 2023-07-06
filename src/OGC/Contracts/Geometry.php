<?php

namespace GlaivePro\SF\OGC\Contracts;

use GlaivePro\SF\Expression;

/**
 * Defines geometry model according to
 * 6.1.2 Geometry
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 */
interface Geometry
{
	// Basic methods
	public function dimension(): Expression; // Integer-valued expression
	public function coordinateDimension(): Expression; // Integer-valued expression
	public function spatialDimension(): Expression; // Integer-valued expression
	public function geometryType(): Expression; // String-valued expression
	public function SRID(): Expression; // Integer-valued expression
	public function envelope(): self;
	public function asText(): Expression; // String-valued expression
	public function asBinary(): Expression; // Binary-valued expression
	public function isEmpty(): Expression; // Boolean-valued expression
	public function isSimple(): Expression; // Boolean-valued expression
	public function is3D(): Expression; // Boolean-valued expression
	public function isMeasured(): Expression; // Boolean-valued expression
	public function boundary(): self;

	// Query methods
	public function equals(self|string $another): Expression; // Boolean-valued expression
	public function disjoint(self|string $another): Expression; // Boolean-valued expression
	public function intersects(self|string $another): Expression; // Boolean-valued expression
	public function touches(self|string $another): Expression; // Boolean-valued expression
	public function crosses(self|string $another): Expression; // Boolean-valued expression
	public function within(self|string $another): Expression; // Boolean-valued expression
	public function contains(self|string $another): Expression; // Boolean-valued expression
	public function overlaps(self|string $another): Expression; // Boolean-valued expression
	public function relate(self|string $another, string $matrix): Expression; // Boolean-valued expression
	public function locateAlong(float $mValue): self;
	public function locateBetween(float $mStart, float $mEnd): self;

	// Analysis methods
	public function distance(self|string $another): Expression; // Distance(float)-valued expression
	public function buffer(float|Expression $distance): self;
	public function convexHull(): self;
	public function intersection(self|string $another): self;
	public function union(self|string $another): self;
	public function difference(self|string $another): self;
	public function symDifference(self|string $another): self;
}
