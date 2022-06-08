<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\OGC\Geometry;
use TontonsB\SF\OGC\GeometryCollection;
use TontonsB\SF\OGC\Point;
use TontonsB\SF\OGC\Sfc;

class WktConstructorTest extends TestCase
{
	public function testGeomFromText(): void
	{
		$geom = Sfc::geomFromText('text');
		$this->assertEquals(
			'ST_GeomFromText(?)',
			(string) $geom,
		);
		$this->assertEquals(['text'], $geom->bindings);
		$this->assertInstanceOf(Geometry::class, $geom);

		$geomWithSRID = Sfc::geomFromText('text', 4326);
		$this->assertEquals(
			'ST_GeomFromText(?, ?)',
			(string) $geomWithSRID,
		);
		$this->assertEquals(['text', 4326], $geomWithSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $geomWithSRID);
	}

	public function testPointFromText(): void
	{
		$point = Sfc::pointFromText('text');
		$this->assertEquals(
			'ST_PointFromText(?)',
			(string) $point,
		);
		$this->assertEquals(['text'], $point->bindings);
		$this->assertInstanceOf(Point::class, $point);

		$pointWithSRID = Sfc::pointFromText('text', 4326);
		$this->assertEquals(
			'ST_PointFromText(?, ?)',
			(string) $pointWithSRID,
		);
		$this->assertEquals(['text', 4326], $pointWithSRID->bindings);
		$this->assertInstanceOf(Point::class, $pointWithSRID);
	}

	public function testGeomCollFromText(): void
	{
		$geomColl = Sfc::geomCollFromText('text');
		$this->assertEquals(
			'ST_GeomCollFromText(?)',
			(string) $geomColl,
		);
		$this->assertEquals(['text'], $geomColl->bindings);
		$this->assertInstanceOf(GeometryCollection::class, $geomColl);

		$geomCollWithSRID = Sfc::geomCollFromText('text', 4326);
		$this->assertEquals(
			'ST_GeomCollFromText(?, ?)',
			(string) $geomCollWithSRID,
		);
		$this->assertEquals(['text', 4326], $geomCollWithSRID->bindings);
		$this->assertInstanceOf(GeometryCollection::class, $geomCollWithSRID);
	}
}
