<?php

namespace Janaseta\SF\Tests;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\OGC\Contracts;
use Janaseta\SF\OGC\Polygon;
use Janaseta\SF\OGC\Triangle;

class PolygonTest extends TestCase
{
	public function testMethodResults(): void
	{
		$polygon = new Polygon('polygon');

		$ring = $polygon->exteriorRing();
		$this->assertEquals(
			'ST_ExteriorRing(polygon)',
			(string) $ring,
		);
		$this->assertInstanceOf(Contracts\LineString::class, $ring);

		$this->assertEquals(
			'ST_NumInteriorRing(polygon)',
			(string) $polygon->numInteriorRing(),
		);

		$ringN = $polygon->interiorRingN(4);
		$this->assertEquals(
			'ST_InteriorRingN(polygon, ?)',
			(string) $ringN,
		);
		$this->assertEquals([4], $ringN->bindings);
		$this->assertInstanceOf(Contracts\LineString::class, $ringN);
	}

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\Triangle::class, new Triangle('triangle'));
	}
}
