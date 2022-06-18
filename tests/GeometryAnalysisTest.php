<?php

namespace TontonsB\SF\Tests;

use TontonsB\SF\Expression;
use TontonsB\SF\OGC\Geometry;

class GeometryAnalysisTest extends GeometryTestCase
{
	public function testMethodResults(): void
	{
		$another = new Geometry('another');

		$this->assertEquals(
			'ST_Distance(geom, another)',
			(string) $this->geom->distance($another),
		);

		// Buffer is tested separately as well, see below.
		$this->assertEquals(
			'ST_Buffer(geom, ?)',
			(string) $this->geom->buffer(6),
		);

		$convexHull = $this->geom->convexHull();
		$this->assertEquals('ST_ConvexHull(geom)', $convexHull);
		$this->assertInstanceOf(Geometry::class, $convexHull);

		$this->assertEquals(
			'ST_Intersection(geom, another)',
			(string) $this->geom->intersection($another),
		);

		$this->assertEquals(
			'ST_Union(geom, another)',
			(string) $this->geom->union($another),
		);

		$this->assertEquals(
			'ST_Difference(geom, another)',
			(string) $this->geom->difference($another),
		);

		$this->assertEquals(
			'ST_SymDifference(geom, another)',
			(string) $this->geom->symDifference($another),
		);
	}

	public function testBuffer(): void
	{
		// With raw value
		$b1 = $this->geom->buffer(10);

		$this->assertInstanceOf(Geometry::class, $b1);
		$this->assertEquals('ST_Buffer(geom, ?)', (string) $b1);
		$this->assertEquals([10.0], $b1->bindings);

		// With expression
		$b2 = $this->geom->buffer(new Expression('10'));

		$this->assertInstanceOf(Geometry::class, $b2);
		$this->assertEquals('ST_Buffer(geom, 10)', (string) $b2);
		$this->assertEquals([], $b2->bindings);
	}

	public function testCombine(): void
	{
		$geom = new Geometry('ST_MakePoint(?, ?)', [1, 2]);
		$another = new Geometry('ST_MakePoint(?, ?)', [3, 4]);

		$union = $geom->union($another);

		$this->assertEquals(
			'ST_Union(ST_MakePoint(?, ?), ST_MakePoint(?, ?))',
			(string) $union,
		);

		$this->assertEquals(
			[1, 2, 3, 4],
			$union->bindings,
		);

		$this->assertInstanceOf(Geometry::class, $union);
	}
}
