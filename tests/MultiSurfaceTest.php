<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\OGC\Contracts;
use TontonsB\SF\OGC\MultiPolygon;
use TontonsB\SF\OGC\MultiSurface;
use TontonsB\SF\OGC\Point;

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
