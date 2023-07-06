<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Geometry;
use GlaivePro\SF\OGC\Point;
use GlaivePro\SF\OGC\Surface;

class SurfaceTest extends TestCase
{
	public function testMethodResults(): void
	{
		$surface = new Surface('surface');

		$this->assertEquals(
			'ST_Area(surface)',
			(string) $surface->area(),
		);

		$centroid = $surface->centroid();
		$this->assertEquals(
			'ST_Centroid(surface)',
			(string) $centroid,
		);
		$this->assertInstanceOf(Point::class, $centroid);

		$pointOnSurface = $surface->pointOnSurface();
		$this->assertEquals(
			'ST_PointOnSurface(surface)',
			(string) $pointOnSurface,
		);
		$this->assertInstanceOf(Point::class, $pointOnSurface);

		$boundary = $surface->boundary();
		$this->assertEquals(
			'ST_Boundary(surface)',
			(string) $boundary,
		);
		$this->assertInstanceOf(Geometry::class, $boundary);
	}
}
