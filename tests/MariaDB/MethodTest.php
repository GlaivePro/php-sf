<?php

namespace GlaivePro\SF\Tests\MariaDB;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use PHPUnit\Framework\TestCase;
use GlaivePro\SF\MariaDB\Geometry;
use GlaivePro\SF\MariaDB\Point;
use GlaivePro\SF\MariaDB\Polygon;

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
			'ST_GeomFromWKB(ST_AsBinary(geom), ?)',
			(string) $setSRID,
		);
		$this->assertEquals([4326], $setSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $setSRID);
	}

	public function testPolygon(): void
	{
		$polygon = new Polygon('polygon');

		$numInteriorRing = $polygon->numInteriorRing();
		$this->assertEquals(
			'ST_NumInteriorRings(polygon)',
			(string) $numInteriorRing,
		);
	}

	public function testGeometryCoordinateDimensionNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Geometry('geom');
		$curve->coordinateDimension();
	}

	public function testGeometryIs3DNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Geometry('geom');
		$curve->is3D();
	}

	public function testGeometryIsMeasuredNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Geometry('geom');
		$curve->isMeasured();
	}

	public function testGeometryLocateAlongNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Geometry('geom');
		$curve->locateAlong(1.0);
	}

	public function testGeometryLocateBetweenNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Geometry('geom');
		$curve->locateBetween(1.0, 2.0);
	}

	public function testPointZNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Point('point');
		$curve->Z();
	}

	public function testPointMNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Point('point');
		$curve->M();
	}
}
