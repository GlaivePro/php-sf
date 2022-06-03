<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\Expression;
use TontonsB\SF\Geometry;

/**
 * Test exmaples from the docs to ensure docs are correct.
 */
class DocsTest extends TestCase
{
	public function testEnvelope()
	{

		$geometry = new Geometry('ST_MakePoint(?, ?)', [3, 5]);

		$envelope = $geometry->envelope();

		$this->assertSame(
			'ST_Envelope(ST_MakePoint(?, ?))',
			(string) $envelope,
		);

		$this->assertSame(
			[3, 5],
			$envelope->bindings,
		);
	}

	public function testChain()
	{
		$geometry = new Geometry('ST_MakePoint(?, ?)', [3, 5]);
		$another = new Geometry("'LINESTRING ( 2 0, 0 2 )'::geometry");

		$expression = $geometry
			->union($another)
			->buffer($geometry->distance('ST_MakePoint(1, 1)'))
			->buffer(5.2)
			->convexHull();

			$this->assertSame(
			"ST_ConvexHull(ST_Buffer(ST_Buffer(ST_Union(ST_MakePoint(?, ?), 'LINESTRING ( 2 0, 0 2 )'::geometry), ST_Distance(ST_MakePoint(?, ?), ST_MakePoint(1, 1))), ?))",
			(string) $expression,
		);

		$this->assertSame(
			[3, 5, 3, 5, 5.2],
			$expression->bindings,
		);
	}

	public function testSrid()
	{
		$geom = new Geometry('the_geom');

		$this->assertEquals(
			'ST_SRID(the_geom)',
			(string) $geom->srid(),
		);
	}

	public function testBuffer()
	{
		$geom = new Geometry('geom');

		$bufferSize = new Expression('3 + 5');
		$buf1 = $geom->buffer($bufferSize);
		$this->assertEquals('ST_Buffer(geom, 3 + 5)', (string) $buf1);
		$this->assertEquals([], $buf1->bindings);

		$dynamicBuffer = new Expression('bufpad + ?', [3]);
		$buf2 = $geom->buffer($dynamicBuffer);
		$this->assertEquals('ST_Buffer(geom, bufpad + ?)', (string) $buf2);
		$this->assertEquals([3], $buf2->bindings);
	}

	public function testGeometryTypeHints()
	{
		$geom = new Geometry('geom');

		$this->assertIsObject(
			$geom->intersects("'LINESTRING ( 2 0, 0 2 )'::geometry")
		);


		$this->assertIsObject(
			$geom->intersects('ST_MakePoint(3, 5)')
		);

		$point = new Geometry('ST_MakePoint(?, ?)', [3, 5]);
		$this->assertIsObject(
			$geom->intersects($point)
		);

		// $this->expectException();
		$expr = new Expression('ST_MakePoint(?, ?)', [3, 5]);

		$this->assertIsObject(
			$geom->intersects($expr)
		);
	}
}