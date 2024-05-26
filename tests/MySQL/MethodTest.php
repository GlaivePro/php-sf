<?php

namespace GlaivePro\SF\Tests\MySQL;

use GlaivePro\SF\Exceptions\MethodNotImplemented;
use PHPUnit\Framework\TestCase;
use GlaivePro\SF\MySQL\Curve;
use GlaivePro\SF\MySQL\Geometry;
use GlaivePro\SF\MySQL\MultiSurface;
use GlaivePro\SF\MySQL\Point;
use GlaivePro\SF\MySQL\Surface;

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
			'ST_SRID(geom, ?)',
			(string) $setSRID,
		);
		$this->assertEquals([4326], $setSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $setSRID);
	}

	public function testCurveIsRingNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Curve('curve');
		$curve->isRing();
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

	public function testGeometryBoundaryNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Geometry('geom');
		$curve->boundary();
	}

	public function testMultiSurfacePointOnSurfaceNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new MultiSurface('multisurface');
		$curve->pointOnSurface();
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

	public function testSurfacePointOnSurfaceNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		$curve = new Surface('surface');
		$curve->pointOnSurface();
	}

}
