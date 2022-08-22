<?php

namespace Janaseta\SF\Tests\Constructors;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\OGC\Contracts;
use Janaseta\SF\OGC\Sfc;

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
		$this->assertInstanceOf(Contracts\Geometry::class, $geom);

		$geomWithSRID = Sfc::geomFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_GeomFromWKB(?, ?)',
			(string) $geomWithSRID,
		);
		$this->assertEquals(['binary', 4326], $geomWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Geometry::class, $geomWithSRID);
	}

	public function testPointFromWKB(): void
	{
		$point = Sfc::pointFromWKB('binary');
		$this->assertEquals(
			'ST_PointFromWKB(?)',
			(string) $point,
		);
		$this->assertEquals(['binary'], $point->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $point);

		$pointWithSRID = Sfc::pointFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_PointFromWKB(?, ?)',
			(string) $pointWithSRID,
		);
		$this->assertEquals(['binary', 4326], $pointWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $pointWithSRID);
	}

	public function testLineFromWKB(): void
	{
		$lineString = Sfc::lineFromWKB('binary');
		$this->assertEquals(
			'ST_LineFromWKB(?)',
			(string) $lineString,
		);
		$this->assertEquals(['binary'], $lineString->bindings);
		$this->assertInstanceOf(Contracts\LineString::class, $lineString);

		$lineStringWithSRID = Sfc::lineFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_LineFromWKB(?, ?)',
			(string) $lineStringWithSRID,
		);
		$this->assertEquals(['binary', 4326], $lineStringWithSRID->bindings);
		$this->assertInstanceOf(Contracts\LineString::class, $lineStringWithSRID);
	}

	public function testPolyFromWKB(): void
	{
		$polygon = Sfc::polyFromWKB('binary');
		$this->assertEquals(
			'ST_PolyFromWKB(?)',
			(string) $polygon,
		);
		$this->assertEquals(['binary'], $polygon->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygon);

		$polygonWithSRID = Sfc::polyFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_PolyFromWKB(?, ?)',
			(string) $polygonWithSRID,
		);
		$this->assertEquals(['binary', 4326], $polygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygonWithSRID);
	}

	public function testMPointFromWKB(): void
	{
		$mPoint = Sfc::mPointFromWKB('binary');
		$this->assertEquals(
			'ST_MPointFromWKB(?)',
			(string) $mPoint,
		);
		$this->assertEquals(['binary'], $mPoint->bindings);
		$this->assertInstanceOf(Contracts\MultiPoint::class, $mPoint);

		$mPointWithSRID = Sfc::mPointFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_MPointFromWKB(?, ?)',
			(string) $mPointWithSRID,
		);
		$this->assertEquals(['binary', 4326], $mPointWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiPoint::class, $mPointWithSRID);
	}

	public function testMLineFromWKB(): void
	{
		$mLine = Sfc::mLineFromWKB('binary');
		$this->assertEquals(
			'ST_MLineFromWKB(?)',
			(string) $mLine,
		);
		$this->assertEquals(['binary'], $mLine->bindings);
		$this->assertInstanceOf(Contracts\MultiLineString::class, $mLine);

		$mLineWithSRID = Sfc::mLineFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_MLineFromWKB(?, ?)',
			(string) $mLineWithSRID,
		);
		$this->assertEquals(['binary', 4326], $mLineWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiLineString::class, $mLineWithSRID);
	}

	public function testMPolyFromWKB(): void
	{
		$mPolygon = Sfc::mPolyFromWKB('binary');
		$this->assertEquals(
			'ST_MPolyFromWKB(?)',
			(string) $mPolygon,
		);
		$this->assertEquals(['binary'], $mPolygon->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolygon);

		$mPolygonWithSRID = Sfc::mPolyFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_MPolyFromWKB(?, ?)',
			(string) $mPolygonWithSRID,
		);
		$this->assertEquals(['binary', 4326], $mPolygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolygonWithSRID);
	}

	public function testGeomCollFromWKB(): void
	{
		$geomColl = Sfc::geomCollFromWKB('binary');
		$this->assertEquals(
			'ST_GeomCollFromWKB(?)',
			(string) $geomColl,
		);
		$this->assertEquals(['binary'], $geomColl->bindings);
		$this->assertInstanceOf(Contracts\GeometryCollection::class, $geomColl);

		$geomCollWithSRID = Sfc::geomCollFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_GeomCollFromWKB(?, ?)',
			(string) $geomCollWithSRID,
		);
		$this->assertEquals(['binary', 4326], $geomCollWithSRID->bindings);
		$this->assertInstanceOf(Contracts\GeometryCollection::class, $geomCollWithSRID);
	}

	public function testBdPolyFromWKB(): void
	{
		$polygon = Sfc::bdPolyFromWKB('binary');
		$this->assertEquals(
			'ST_BdPolyFromWKB(?)',
			(string) $polygon,
		);
		$this->assertEquals(['binary'], $polygon->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygon);

		$polygonWithSRID = Sfc::bdPolyFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_BdPolyFromWKB(?, ?)',
			(string) $polygonWithSRID,
		);
		$this->assertEquals(['binary', 4326], $polygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygonWithSRID);
	}

	public function testBdMPolyFromWKB(): void
	{
		$mPolygon = Sfc::bdMPolyFromWKB('binary');
		$this->assertEquals(
			'ST_BdMPolyFromWKB(?)',
			(string) $mPolygon,
		);
		$this->assertEquals(['binary'], $mPolygon->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolygon);

		$mPolygonWithSRID = Sfc::bdMPolyFromWKB('binary', 4326);
		$this->assertEquals(
			'ST_BdMPolyFromWKB(?, ?)',
			(string) $mPolygonWithSRID,
		);
		$this->assertEquals(['binary', 4326], $mPolygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolygonWithSRID);
	}
}
