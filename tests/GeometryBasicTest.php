<?php

namespace TontonsB\SF\Tests;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Geometry;
use TontonsB\SF\Exceptions\MethodNotImplemented;

class GeometryBasicTest extends GeometryTestCase
{
	public function testMethodResults()
	{
		$this->assertEquals(
			'ST_Dimension(geom)',
			(string) $this->geom->dimension(),
		);

		$this->assertEquals(
			'ST_CoordDim(geom)',
			(string) $this->geom->coordinateDimension(),
		);

		$this->assertEquals(
			'ST_GeometryType(geom)',
			(string) $this->geom->geometryType(),
		);

		$this->assertEquals(
			'ST_SRID(geom)',
			(string) $this->geom->SRID(),
		);

		$envelope = $this->geom->envelope();
		$this->assertEquals(
			'ST_Envelope(geom)',
			(string) $envelope,
		);
		$this->assertInstanceOf(Geometry::class, $envelope);

		$this->assertEquals(
			'ST_AsText(geom)',
			(string) $this->geom->asText(),
		);

		$this->assertEquals(
			'ST_AsBinary(geom)',
			(string) $this->geom->asBinary(),
		);

		$this->assertEquals(
			'ST_IsEmpty(geom)',
			(string) $this->geom->isEmpty(),
		);

		$this->assertEquals(
			'ST_IsSimple(geom)',
			(string) $this->geom->isSimple(),
		);

		$this->assertEquals(
			'SE_Is3D(geom)',
			(string) $this->geom->is3D(),
		);

		$this->assertEquals(
			'SE_IsMeasured(geom)',
			(string) $this->geom->isMeasured(),
		);

		$boundary = $this->geom->boundary();
		$this->assertEquals(
			'ST_Boundary(geom)',
			(string) $boundary,
		);
		$this->assertInstanceOf(Geometry::class, $boundary);
	}

	public function testWrappingWithBindings()
	{
		$geom = new Geometry('ST_MakePoint(?, ?)', [4, 2]);

		$dimension = $geom->dimension();

		$this->assertEquals(
			'ST_Dimension(ST_MakePoint(?, ?))',
			(string) $dimension,
		);

		$this->assertEquals(
			[4, 2],
			$dimension->bindings,
		);
	}

	public function testWrapTypes()
	{
		$dimension = $this->geom->dimension();

		$this->assertInstanceOf(Expression::class, $dimension);
		$this->assertNotInstanceOf(Geometry::class, $dimension);
	}

	public function testAssertExceptionReporting()
	{
		$this->expectException(MethodNotImplemented::class);

		$this->geom->spatialDimension();
	}
}
