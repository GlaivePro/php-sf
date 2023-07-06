<?php

namespace GlaivePro\SF\Tests\Geometry;

use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Geometry;

class GeometryQueryTest extends GeometryTestCase
{
	public function testMethodResults(): void
	{
		$another = new Geometry('another');

		$this->assertEquals(
			'ST_Equals(geom, another)',
			(string) $this->geom->equals($another),
		);

		$this->assertEquals(
			'ST_Disjoint(geom, another)',
			(string) $this->geom->disjoint($another),
		);

		$this->assertEquals(
			'ST_Intersects(geom, another)',
			(string) $this->geom->intersects($another),
		);

		$this->assertEquals(
			'ST_Touches(geom, another)',
			(string) $this->geom->touches($another),
		);

		$this->assertEquals(
			'ST_Crosses(geom, another)',
			(string) $this->geom->crosses($another),
		);

		$this->assertEquals(
			'ST_Within(geom, another)',
			(string) $this->geom->within($another),
		);

		$this->assertEquals(
			'ST_Contains(geom, another)',
			(string) $this->geom->contains($another),
		);

		$this->assertEquals(
			'ST_Overlaps(geom, another)',
			(string) $this->geom->overlaps($another),
		);

		$relate = $this->geom->relate($another, 'FF');
		$this->assertEquals(
			'ST_Relate(geom, another, ?)',
			(string) $relate,
		);
		$this->assertEquals(['FF'], $relate->bindings);
		$this->assertInstanceOf(Expression::class, $relate);

		$locateAlong = $this->geom->locateAlong(4.0);
		$this->assertEquals(
			'ST_LocateAlong(geom, ?)',
			(string) $locateAlong,
		);
		$this->assertEquals([4.0], $locateAlong->bindings);
		$this->assertInstanceOf(Geometry::class, $locateAlong);

		// Let's also test coercion here.
		$locateBetween = $this->geom->locateBetween(2, '3');
		$this->assertEquals(
			'ST_LocateBetween(geom, ?, ?)',
			(string) $locateBetween,
		);
		$this->assertEquals([2.0, 3.0], $locateBetween->bindings);
		$this->assertInstanceOf(Geometry::class, $locateBetween);
	}

	public function testWithGeometryType(): void
	{
		$another = new Geometry('somepoint');

		$this->assertEquals(
			'ST_Equals(geom, somepoint)',
			(string) $this->geom->equals($another),
		);
	}

	public function testWithString(): void
	{
		$this->assertEquals(
			'ST_Equals(geom, somepoint)',
			(string) $this->geom->equals('somepoint'),
		);
	}

	public function testBindingHandling(): void
	{
		$another = new Geometry('ST_MakePoint(?, ?)', [1, 4]);

		$equals = $this->geom->equals($another);

		$this->assertEquals(
			'ST_Equals(geom, ST_MakePoint(?, ?))',
			(string) $equals,
		);
		$this->assertEquals([1, 4], $equals->bindings);
	}

	public function testQueryTypes(): void
	{
		$equals = $this->geom->equals('another');

		$this->assertInstanceOf(Expression::class, $equals);
		$this->assertNotInstanceOf(Geometry::class, $equals);
	}
}
