<?php

namespace Janaseta\SF\Tests;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\OGC\Contracts;
use Janaseta\SF\OGC\Line;
use Janaseta\SF\OGC\LinearRing;
use Janaseta\SF\OGC\LineString;

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
