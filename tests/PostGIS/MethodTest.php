<?php

namespace Janaseta\SF\Tests\PostGIS;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\PostGIS\Curve;
use Janaseta\SF\PostGIS\Geometry;
use Janaseta\SF\PostGIS\GeometryCollection;
use Janaseta\SF\PostGIS\Line;
use Janaseta\SF\PostGIS\LinearRing;
use Janaseta\SF\PostGIS\LineString;
use Janaseta\SF\PostGIS\Polygon;
use Janaseta\SF\PostGIS\PolyhedralSurface;
use Janaseta\SF\PostGIS\Surface;
use Janaseta\SF\PostGIS\TIN;
use Janaseta\SF\PostGIS\Triangle;

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
