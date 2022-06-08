<?php

namespace Tontonsb\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\PostGIS\Geometry;
use TontonsB\SF\PostGIS\Point;
use TontonsB\SF\PostGIS\Sfc;

class PostGISTest extends TestCase
{
	public function testGeometry(): void
	{
		$geom = new Geometry('geom');

		$setSRID = $geom->setSRID(4326);
		$this->assertEquals(
			'ST_SetSRID(geom, ?)',
			(string) $setSRID,
		);
		$this->assertEquals([4326], $setSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $setSRID);
	}

	/**
	 * Ensure that the proxied methods create PostGIS objects
	 */
	public function testProxiedConstructors(): void
	{
		$this->assertInstanceOf(Geometry::class, Sfc::geomFromText('text'));

		$this->assertInstanceOf(Point::class, Sfc::pointFromWKB('binary'));
	}

	public function testMakePointConstructors(): void
	{
		$this->assertSame(
			'ST_MakePoint(?, ?)',
			(string) Sfc::makePoint(1, 3),
		);

		$point = Sfc::makePoint(1, 3, 4, 8);
		$this->assertSame(
			'ST_MakePoint(?, ?, ?, ?)',
			(string) $point,
		);
		$this->assertEquals([1, 3, 4, 8], $point->bindings);

		$this->assertSame(
			'ST_MakePoint(?, ?, ?)',
			(string) Sfc::makePoint(1, 3, 6),
		);

		$mixedOrderPoint = Sfc::makePoint(y: 1, z: 3, x: 6);
		$this->assertSame(
			'ST_MakePoint(?, ?, ?)',
			(string) $mixedOrderPoint,
		);
		$this->assertEquals([6, 1, 3], $mixedOrderPoint->bindings);

		$this->assertSame(
			'ST_MakePoint(?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 6),
		);

		$pointM = Sfc::makePoint(1, 3, m: 6);
		$this->assertSame(
			'ST_MakePointM(?, ?, ?)',
			(string) $pointM,
		);
		$this->assertEquals([1, 3, 6], $pointM->bindings);

		$pointMM = Sfc::makePointM(1, 3, 6);
		$this->assertSame(
			'ST_MakePointM(?, ?, ?)',
			(string) $pointMM,
		);
		$this->assertEquals([1, 3, 6], $pointMM->bindings);
	}

	public function testPointConstructors(): void
	{
		$point = Sfc::point(1, 3);
		$this->assertSame(
			'ST_Point(?, ?)',
			(string) $point,
		);
		$this->assertEquals([1, 3], $point->bindings);

		$pointWithSrid = Sfc::point(1, 3, 4326);
		$this->assertSame(
			'ST_Point(?, ?, ?)',
			(string) $pointWithSrid,
		);
		$this->assertEquals([1, 3, 4326], $pointWithSrid->bindings);

		$pointM = Sfc::point(1, 3, m: 8, srid: 4326);
		$this->assertSame(
			'ST_PointM(?, ?, ?, ?)',
			(string) $pointM,
		);
		$this->assertEquals([1, 3, 8, 4326], $pointM->bindings);

		$this->assertSame(
			'ST_PointZ(?, ?, ?)',
			(string) Sfc::point(1, 3, z: 4),
		);

		$this->assertSame(
			'ST_PointZ(?, ?, ?, ?)',
			(string) Sfc::point(1, 3, 4326, 8),
		);

		$this->assertSame(
			'ST_PointM(?, ?, ?)',
			(string) Sfc::point(1, 3, m: 8),
		);

		$this->assertSame(
			'ST_PointZM(?, ?, ?, ?)',
			(string) Sfc::point(1, 3, z: 4, m: 8),
		);

		$this->assertSame(
			'ST_PointZM(?, ?, ?, ?, ?)',
			(string) Sfc::point(1, 3, z: 4, m: 8, srid: 4326),
		);

		$this->assertSame(
			'ST_PointZ(?, ?, ?)',
			(string) Sfc::pointZ(1, 3, 4),
		);

		$this->assertSame(
			'ST_PointZ(?, ?, ?, ?)',
			(string) Sfc::pointZ(1, 3, 4, 4326),
		);

		$this->assertSame(
			'ST_PointM(?, ?, ?)',
			(string) Sfc::pointM(1, 3, 8),
		);

		$this->assertSame(
			'ST_PointM(?, ?, ?, ?)',
			(string) Sfc::pointM(1, 3, 8, 4326),
		);

		$this->assertSame(
			'ST_PointZM(?, ?, ?, ?)',
			(string) Sfc::pointZM(1, 3, 4, 8),
		);

		$this->assertSame(
			'ST_PointZM(?, ?, ?, ?, ?)',
			(string) Sfc::pointZM(1, 3, 4, 8, 4326),
		);
	}
}
