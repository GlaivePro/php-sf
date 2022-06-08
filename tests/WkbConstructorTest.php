<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\OGC\Geometry;
use TontonsB\SF\OGC\GeometryCollection;
use TontonsB\SF\OGC\Point;
use TontonsB\SF\OGC\Sfc;

class WkbConstructorTest extends TestCase
{
	public function testGeomFromWKB(): void
	{
		$geom = Sfc::geomFromWKB('binary');
		$this->assertEquals(
			'ST_GeomFromWKB(?)',
			(string) $geom,
		);
		$this->assertEquals(['binary'], $geom->bindings);
		$this->assertInstanceOf(Geometry::class, $geom);

		$geomWithSRID = Sfc::geomFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_GeomFromWKB(?, ?)',
			(string) $geomWithSRID,
		);
		$this->assertEquals(['binary', 4326], $geomWithSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $geomWithSRID);
	}

	public function testPointFromWKB(): void
	{
		$point = Sfc::pointFromWKB('binary');
		$this->assertEquals(
			'ST_PointFromWKB(?)',
			(string) $point,
		);
		$this->assertEquals(['binary'], $point->bindings);
		$this->assertInstanceOf(Point::class, $point);

		$pointWithSRID = Sfc::pointFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_PointFromWKB(?, ?)',
			(string) $pointWithSRID,
		);
		$this->assertEquals(['binary', 4326], $pointWithSRID->bindings);
		$this->assertInstanceOf(Point::class, $pointWithSRID);
	}

	public function testGeomCollFromWKB(): void
	{
		$geomColl = Sfc::geomCollFromWKB('binary');
		$this->assertEquals(
			'ST_GeomCollFromWKB(?)',
			(string) $geomColl,
		);
		$this->assertEquals(['binary'], $geomColl->bindings);
		$this->assertInstanceOf(GeometryCollection::class, $geomColl);

		$geomCollWithSRID = Sfc::geomCollFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_GeomCollFromWKB(?, ?)',
			(string) $geomCollWithSRID,
		);
		$this->assertEquals(['binary', 4326], $geomCollWithSRID->bindings);
		$this->assertInstanceOf(GeometryCollection::class, $geomCollWithSRID);
	}
}
