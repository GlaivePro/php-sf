<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC\MultiPolygon;
use GlaivePro\SF\OGC\MultiSurface;
use GlaivePro\SF\OGC\Point;

class MultiSurfaceTest extends TestCase
{
	public function testMethodResults(): void
	{
		$msurface = new MultiSurface('msurface');

		$this->assertEquals(
			'ST_Area(msurface)',
			(string) $msurface->area(),
		);

		$centroid = $msurface->centroid();
		$this->assertEquals(
			'ST_Centroid(msurface)',
			(string) $centroid,
		);
		$this->assertInstanceOf(Point::class, $centroid);

		$pointOnSurface = $msurface->pointOnSurface();
		$this->assertEquals(
			'ST_PointOnSurface(msurface)',
			(string) $pointOnSurface,
		);
		$this->assertInstanceOf(Point::class, $pointOnSurface);
	}

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\MultiPolygon::class, new MultiPolygon('mpolygon'));
	}
}
