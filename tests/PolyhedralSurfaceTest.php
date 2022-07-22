<?php

namespace Janaseta\SF\Tests;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\Exceptions\MethodNotImplemented;
use Janaseta\SF\OGC\Contracts;
use Janaseta\SF\OGC\Polygon;
use Janaseta\SF\OGC\PolyhedralSurface;
use Janaseta\SF\OGC\TIN;

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
