<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC\Line;
use GlaivePro\SF\OGC\LinearRing;
use GlaivePro\SF\OGC\LineString;

class LineStringTest extends TestCase
{
	public function testMethodResults(): void
	{
		$lineString = new LineString('lineString');

		$this->assertEquals(
			'ST_NumPoints(lineString)',
			(string) $lineString->numPoints(),
		);

		$pointN = $lineString->pointN(7);
		$this->assertEquals(
			'ST_PointN(lineString, ?)',
			(string) $pointN,
		);
		$this->assertEquals([7], $pointN->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $pointN);
	}

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\Line::class, new Line('line'));

		$this->assertInstanceOf(Contracts\LinearRing::class, new LinearRing('linearRing'));
	}
}
