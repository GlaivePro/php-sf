<?php

namespace Janaseta\SF\Tests;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\SpatiaLite\Geometry;
use Janaseta\SF\SpatiaLite\Point;
use Janaseta\SF\SpatiaLite\Sfc;

class SpatiaLiteTest extends TestCase
{
	public function testGeometry(): void
	{
		$geom = new Geometry('geom');

		$setSRID = $geom->setSRID(4326);
		$this->assertEquals(
			'SetSRID(geom, ?)',
			(string) $setSRID,
		);
		$this->assertEquals([4326], $setSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $setSRID);
	}

	/**
	 * Ensure that the proxied methods create SpatiaLite objects
	 */
	public function testProxiedConstructors(): void
	{
		$this->assertInstanceOf(Geometry::class, Sfc::geomFromText('text'));

		$this->assertInstanceOf(Point::class, Sfc::pointFromWKB('binary'));
	}

	public function testPointConstructor(): void
	{
		$point = Sfc::point(1, 3);
		$this->assertSame(
			'ST_Point(?, ?)',
			(string) $point,
		);
		$this->assertEquals([1, 3], $point->bindings);
	}

	public function testMakePointConstructors(): void
	{
		$point = Sfc::makePoint(1, 3);
		$this->assertSame(
			'MakePoint(?, ?)',
			(string) $point,
		);
		$this->assertEquals([1, 3], $point->bindings);

		$pointWithSrid = Sfc::makePoint(1, 3, 4326);
		$this->assertSame(
			'MakePoint(?, ?, ?)',
			(string) $pointWithSrid,
		);
		$this->assertEquals([1, 3, 4326], $pointWithSrid->bindings);

		$pointM = Sfc::makePoint(1, 3, m: 8, srid: 4326);
		$this->assertSame(
			'MakePointM(?, ?, ?, ?)',
			(string) $pointM,
		);
		$this->assertEquals([1, 3, 8, 4326], $pointM->bindings);

		$this->assertSame(
			'MakePointZ(?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 4),
		);

		$this->assertSame(
			'MakePointZ(?, ?, ?, ?)',
			(string) Sfc::makePoint(1, 3, 4326, 8),
		);

		$this->assertSame(
			'MakePointM(?, ?, ?)',
			(string) Sfc::makePoint(1, 3, m: 8),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 4, m: 8),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 4, m: 8, srid: 4326),
		);

		$this->assertSame(
			'MakePointZ(?, ?, ?)',
			(string) Sfc::makePointZ(1, 3, 4),
		);

		$this->assertSame(
			'MakePointZ(?, ?, ?, ?)',
			(string) Sfc::makePointZ(1, 3, 4, 4326),
		);

		$this->assertSame(
			'MakePointM(?, ?, ?)',
			(string) Sfc::makePointM(1, 3, 8),
		);

		$this->assertSame(
			'MakePointM(?, ?, ?, ?)',
			(string) Sfc::makePointM(1, 3, 8, 4326),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?)',
			(string) Sfc::makePointZM(1, 3, 4, 8),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?, ?)',
			(string) Sfc::makePointZM(1, 3, 4, 8, 4326),
		);
	}
}
