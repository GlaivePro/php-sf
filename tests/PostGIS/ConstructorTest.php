<?php

namespace Janaseta\SF\Tests\PostGIS;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\Expression;
use Janaseta\SF\PostGIS\LineString;
use Janaseta\SF\PostGIS\Sfc;

class ConstructorTest extends TestCase
{
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

	public function testLineStringConstructors(): void
	{
		$lineString = Sfc::makeLine(new Expression('line'));
		$this->assertSame(
			'ST_MakeLine(line)',
			(string) $lineString,
		);
		$this->assertInstanceOf(LineString::class, $lineString);

		$lineFromText = Sfc::lineFromText('text');
		$this->assertSame(
			'ST_LineFromText(?)',
			(string) $lineFromText,
		);
		$this->assertInstanceOf(LineString::class, $lineFromText);
	}
}
