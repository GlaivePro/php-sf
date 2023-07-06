<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC\Geometry;
use GlaivePro\SF\OGC\GeometryCollection;
use GlaivePro\SF\OGC\MultiPoint;

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

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\MultiPoint::class, new MultiPoint('mpoint'));
	}
}
