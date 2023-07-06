<?php

namespace GlaivePro\SF\Tests\PostGIS;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\PostGIS\Curve;
use GlaivePro\SF\PostGIS\Geometry;
use GlaivePro\SF\PostGIS\GeometryCollection;
use GlaivePro\SF\PostGIS\Line;
use GlaivePro\SF\PostGIS\LinearRing;
use GlaivePro\SF\PostGIS\LineString;
use GlaivePro\SF\PostGIS\Polygon;
use GlaivePro\SF\PostGIS\PolyhedralSurface;
use GlaivePro\SF\PostGIS\Surface;
use GlaivePro\SF\PostGIS\TIN;
use GlaivePro\SF\PostGIS\Triangle;

/**
 * Ensure that methods use the dialect-specific syntax.
 */
class MethodTest extends TestCase
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

	/**
	 * More checks for SetSRID and CoordDim to ensure that the geometry
	 * subclasses are correct as well.
	 */
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
}
