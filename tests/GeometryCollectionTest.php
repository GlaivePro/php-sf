<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\OGC\Geometry;
use TontonsB\SF\OGC\GeometryCollection;

class GeometryCollectionTest extends TestCase
{
	public function testMethodResults(): void
	{
		$geomCollection = new GeometryCollection('geom');

		$this->assertEquals(
			'ST_NumGeometries(geom)',
			(string) $geomCollection->numGeometries(),
		);

		$geomN = $geomCollection->geometryN(7);
		$this->assertEquals(
			'ST_GeometryN(geom, ?)',
			(string) $geomN,
		);
		$this->assertEquals([7], $geomN->bindings);
		$this->assertInstanceOf(Geometry::class, $geomN);
	}
}
