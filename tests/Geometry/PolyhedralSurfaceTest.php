<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC\Polygon;
use GlaivePro\SF\OGC\PolyhedralSurface;
use GlaivePro\SF\OGC\TIN;

class PolyhedralSurfaceTest extends TestCase
{
	public function testMethodResults(): void
	{
		$surface = new PolyhedralSurface('surface');

		$this->assertEquals(
			'ST_NumSurfaces(surface)',
			(string) $surface->numPatches(),
		);

		$patchN = $surface->patchN(8);
		$this->assertEquals(
			'ST_Surface(surface, ?)',
			(string) $patchN,
		);
		$this->assertEquals([8], $patchN->bindings);
		$this->assertInstanceOf(Contracts\Polygon::class, $patchN);
	}

	public function testBoundingPolygonsNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		(new PolyhedralSurface('surface'))->boundingPolygons(new Polygon('poly'));
	}

	public function testIsClosedNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);

		(new PolyhedralSurface('surface'))->isClosed();
	}

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\TIN::class, new TIN('tin'));
	}
}
