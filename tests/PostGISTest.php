<?php

namespace Tontonsb\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\Exceptions\MethodNotImplemented;
use TontonsB\SF\Expression;
use TontonsB\SF\PostGIS\Curve;
use TontonsB\SF\PostGIS\Geometry;
use TontonsB\SF\PostGIS\GeometryCollection;
use TontonsB\SF\PostGIS\Line;
use TontonsB\SF\PostGIS\LinearRing;
use TontonsB\SF\PostGIS\LineString;
use TontonsB\SF\PostGIS\MultiCurve;
use TontonsB\SF\PostGIS\MultiLineString;
use TontonsB\SF\PostGIS\MultiPoint;
use TontonsB\SF\PostGIS\MultiPolygon;
use TontonsB\SF\PostGIS\Point;
use TontonsB\SF\PostGIS\Polygon;
use TontonsB\SF\PostGIS\PolyhedralSurface;
use TontonsB\SF\PostGIS\Sfc;
use TontonsB\SF\PostGIS\Surface;
use TontonsB\SF\PostGIS\TIN;
use TontonsB\SF\PostGIS\Triangle;

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

		$this->assertEquals(
			'ST_CoordDim(geom)',
			(string) $geom->coordDim(),
		);

		$this->assertEquals(
			'ST_CoordDim(geom)',
			(string) $geom->nDims(),
		);
	}

	public function testPolyhedralSurface(): void
	{
		$poly = new PolyhedralSurface('poly');

		$this->assertEquals(
			'ST_NumPatches(poly)',
			(string) $poly->numPatches(),
		);

		$patchN = $poly->patchN(4);
		$this->assertEquals(
			'ST_PatchN(poly, ?)',
			(string) $patchN,
		);
		$this->assertEquals([4], $patchN->bindings);

		$this->assertEquals(
			'ST_IsClosed(poly)',
			(string) $poly->isClosed(),
		);
	}

	// Just to ensure extensions and imports are working
	public function testModels(): void
	{
		$this->assertEquals(
			'ST_SetSRID(curve, ?)',
			(string) (new Curve('curve'))->setSRID(3059),
		);

		$this->assertEquals(
			'ST_CoordDim(geom)',
			(string) (new GeometryCollection('geom'))->coordDim(),
		);

		$this->assertEquals(
			'ST_CoordDim(surface)',
			(string) (new Surface('surface'))->nDims(),
		);

		$this->assertEquals(
			'ST_SetSRID(line, ?)',
			(string) (new LineString('line'))->setSRID(3059),
		);

		$this->assertEquals(
			'ST_CoordDim(line)',
			(string) (new Line('line'))->coordDim(),
		);

		$this->assertEquals(
			'ST_CoordDim(line)',
			(string) (new LinearRing('line'))->nDims(),
		);

		$this->assertEquals(
			'ST_SetSRID(polygon, ?)',
			(string) (new Polygon('polygon'))->setSRID(3059),
		);

		$this->assertEquals(
			'ST_CoordDim(triangle)',
			(string) (new Triangle('triangle'))->coordDim(),
		);

		$this->assertEquals(
			'ST_CoordDim(tin)',
			(string) (new TIN('tin'))->nDims(),
		);
	}

	public function testTypes(): void
	{
		$geom = new Geometry('geom');

		$this->assertInstanceOf(
			Geometry::class,
			$geom,
		);

		$this->assertInstanceOf(
			Geometry::class,
			$geom->envelope(),
		);

		$this->assertInstanceOf(
			MultiCurve::class,
			(new Surface('surface'))->boundary(),
		);
	}

	/**
	 * Ensure that the proxied methods create PostGIS objects
	 */
	public function testProxiedConstructors(): void
	{
		$this->assertInstanceOf(Geometry::class, Sfc::geomFromText('text'));
		$this->assertInstanceOf(GeometryCollection::class, Sfc::geomCollFromText('text'));
		$this->assertInstanceOf(MultiPolygon::class, Sfc::mPolyFromText('text'));

		$this->assertInstanceOf(Point::class, Sfc::pointFromWKB('binary'));
		$this->assertInstanceOf(MultiPoint::class, Sfc::mPointFromWKB('binary'));
		$this->assertInstanceOf(MultiLineString::class, Sfc::mLineFromWKB('binary'));
	}

	public function testBdPolyFromWkbNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdPolyFromWKB('binary');
	}

	public function testBdMPolyFromWkbNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdMPolyFromWKB('binary');
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
