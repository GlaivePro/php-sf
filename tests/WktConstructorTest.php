<?php

namespace Janaseta\SF\Tests;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\OGC\Contracts;
use Janaseta\SF\OGC\Sfc;

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
		$this->assertInstanceOf(Contracts\Geometry::class, $geom);

		$geomWithSRID = Sfc::geomFromText('text', 4326);
		$this->assertEquals(
			'ST_GeomFromText(?, ?)',
			(string) $geomWithSRID,
		);
		$this->assertEquals(['text', 4326], $geomWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Geometry::class, $geomWithSRID);
	}

	public function testPointFromText(): void
	{
		$point = Sfc::pointFromText('text');
		$this->assertEquals(
			'ST_PointFromText(?)',
			(string) $point,
		);
		$this->assertEquals(['text'], $point->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $point);

		$pointWithSRID = Sfc::pointFromText('text', 4326);
		$this->assertEquals(
			'ST_PointFromText(?, ?)',
			(string) $pointWithSRID,
		);
		$this->assertEquals(['text', 4326], $pointWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $pointWithSRID);
	}

	public function testLineFromText(): void
	{
		$lineString = Sfc::lineFromText('text');
		$this->assertEquals(
			'ST_LineFromText(?)',
			(string) $lineString,
		);
		$this->assertEquals(['text'], $lineString->bindings);
		$this->assertInstanceOf(Contracts\LineString::class, $lineString);

		$lineStringWithSRID = Sfc::lineFromText('text', 4326);
		$this->assertEquals(
			'ST_LineFromText(?, ?)',
			(string) $lineStringWithSRID,
		);
		$this->assertEquals(['text', 4326], $lineStringWithSRID->bindings);
		$this->assertInstanceOf(Contracts\LineString::class, $lineStringWithSRID);
	}

	public function testPolyFromText(): void
	{
		$polygon = Sfc::polyFromText('text');
		$this->assertEquals(
			'ST_PolyFromText(?)',
			(string) $polygon,
		);
		$this->assertEquals(['text'], $polygon->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygon);

		$polygonWithSRID = Sfc::polyFromText('text', 4326);
		$this->assertEquals(
			'ST_PolyFromText(?, ?)',
			(string) $polygonWithSRID,
		);
		$this->assertEquals(['text', 4326], $polygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygonWithSRID);
	}

	public function testMPointFromText(): void
	{
		$mPoint = Sfc::mPointFromText('text');
		$this->assertEquals(
			'ST_MPointFromText(?)',
			(string) $mPoint,
		);
		$this->assertEquals(['text'], $mPoint->bindings);
		$this->assertInstanceOf(Contracts\MultiPoint::class, $mPoint);

		$mPointWithSRID = Sfc::mPointFromText('text', 4326);
		$this->assertEquals(
			'ST_MPointFromText(?, ?)',
			(string) $mPointWithSRID,
		);
		$this->assertEquals(['text', 4326], $mPointWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiPoint::class, $mPointWithSRID);
	}

	public function testMLineFromText(): void
	{
		$mLine = Sfc::mLineFromText('text');
		$this->assertEquals(
			'ST_MLineFromText(?)',
			(string) $mLine,
		);
		$this->assertEquals(['text'], $mLine->bindings);
		$this->assertInstanceOf(Contracts\MultiLineString::class, $mLine);

		$mLineWithSRID = Sfc::mLineFromText('text', 4326);
		$this->assertEquals(
			'ST_MLineFromText(?, ?)',
			(string) $mLineWithSRID,
		);
		$this->assertEquals(['text', 4326], $mLineWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiLineString::class, $mLineWithSRID);
	}

	public function testMPolyFromText(): void
	{
		$mPoly = Sfc::mPolyFromText('text');
		$this->assertEquals(
			'ST_MPolyFromText(?)',
			(string) $mPoly,
		);
		$this->assertEquals(['text'], $mPoly->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPoly);

		$mPolyWithSRID = Sfc::mPolyFromText('text', 4326);
		$this->assertEquals(
			'ST_MPolyFromText(?, ?)',
			(string) $mPolyWithSRID,
		);
		$this->assertEquals(['text', 4326], $mPolyWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolyWithSRID);
	}

	public function testGeomCollFromText(): void
	{
		$geomColl = Sfc::geomCollFromText('text');
		$this->assertEquals(
			'ST_GeomCollFromText(?)',
			(string) $geomColl,
		);
		$this->assertEquals(['text'], $geomColl->bindings);
		$this->assertInstanceOf(Contracts\GeometryCollection::class, $geomColl);

		$geomCollWithSRID = Sfc::geomCollFromText('text', 4326);
		$this->assertEquals(
			'ST_GeomCollFromText(?, ?)',
			(string) $geomCollWithSRID,
		);
		$this->assertEquals(['text', 4326], $geomCollWithSRID->bindings);
		$this->assertInstanceOf(Contracts\GeometryCollection::class, $geomCollWithSRID);
	}

	public function testBdPolyFromText(): void
	{
		$polygon = Sfc::bdPolyFromText('text');
		$this->assertEquals(
			'ST_BdPolyFromText(?)',
			(string) $polygon,
		);
		$this->assertEquals(['text'], $polygon->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygon);

		$polygonWithSRID = Sfc::bdPolyFromText('text', 4326);
		$this->assertEquals(
			'ST_BdPolyFromText(?, ?)',
			(string) $polygonWithSRID,
		);
		$this->assertEquals(['text', 4326], $polygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $polygonWithSRID);
	}

	public function testBdMPolyFromText(): void
	{
		$mPolygon = Sfc::bdMPolyFromText('text');
		$this->assertEquals(
			'ST_BdMPolyFromText(?)',
			(string) $mPolygon,
		);
		$this->assertEquals(['text'], $mPolygon->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolygon);

		$mPolygonWithSRID = Sfc::bdMPolyFromText('text', 4326);
		$this->assertEquals(
			'ST_BdMPolyFromText(?, ?)',
			(string) $mPolygonWithSRID,
		);
		$this->assertEquals(['text', 4326], $mPolygonWithSRID->bindings);
		$this->assertInstanceOf(Contracts\MultiPolygon::class, $mPolygonWithSRID);
	}
}
