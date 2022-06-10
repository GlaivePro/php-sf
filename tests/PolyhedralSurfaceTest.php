<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\Exceptions\MethodNotImplemented;
use TontonsB\SF\OGC\Contracts;
use TontonsB\SF\OGC\Polygon;
use TontonsB\SF\OGC\PolyhedralSurface;
use TontonsB\SF\OGC\TIN;

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

	public function testBoundingPolygonsNotImplemented()
	{
		$this->expectException(MethodNotImplemented::class);

		(new PolyhedralSurface('surface'))->boundingPolygons(new Polygon('poly'));
	}


	public function testIsClosedNotImplemented()
	{
		$this->expectException(MethodNotImplemented::class);

		(new PolyhedralSurface('surface'))->isClosed();
	}

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\TIN::class, new TIN('tin'));
	}
}
