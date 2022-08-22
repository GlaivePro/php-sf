<?php

namespace Janaseta\SF\Tests\SpatiaLite;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\SpatiaLite\Sfc;

/**
 * Test SpatiaLite specific constructors.
 */
class ConstructorTest extends TestCase
{
	public function testPoint(): void
	{
		$point = Sfc::point(1, 3);
		$this->assertSame(
			'ST_Point(?, ?)',
			(string) $point,
		);
		$this->assertEquals([1, 3], $point->bindings);
	}

	public function testMakePoint(): void
	{
		$point = Sfc::makePoint(1, 3);
		$this->assertSame(
			'MakePoint(?, ?)',
			(string) $point,
		);
		$this->assertEquals([1, 3], $point->bindings);

		$pointWithSrid = Sfc::makePoint(1, 3, 4326);
		$this->assertSame(
			'MakePoint(?, ?, ?)',
			(string) $pointWithSrid,
		);
		$this->assertEquals([1, 3, 4326], $pointWithSrid->bindings);

		$pointM = Sfc::makePoint(1, 3, m: 8, srid: 4326);
		$this->assertSame(
			'MakePointM(?, ?, ?, ?)',
			(string) $pointM,
		);
		$this->assertEquals([1, 3, 8, 4326], $pointM->bindings);

		$this->assertSame(
			'MakePointZ(?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 4),
		);

		$this->assertSame(
			'MakePointZ(?, ?, ?, ?)',
			(string) Sfc::makePoint(1, 3, 4326, 8),
		);

		$this->assertSame(
			'MakePointM(?, ?, ?)',
			(string) Sfc::makePoint(1, 3, m: 8),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 4, m: 8),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?, ?)',
			(string) Sfc::makePoint(1, 3, z: 4, m: 8, srid: 4326),
		);

		$this->assertSame(
			'MakePointZ(?, ?, ?)',
			(string) Sfc::makePointZ(1, 3, 4),
		);

		$this->assertSame(
			'MakePointZ(?, ?, ?, ?)',
			(string) Sfc::makePointZ(1, 3, 4, 4326),
		);

		$this->assertSame(
			'MakePointM(?, ?, ?)',
			(string) Sfc::makePointM(1, 3, 8),
		);

		$this->assertSame(
			'MakePointM(?, ?, ?, ?)',
			(string) Sfc::makePointM(1, 3, 8, 4326),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?)',
			(string) Sfc::makePointZM(1, 3, 4, 8),
		);

		$this->assertSame(
			'MakePointZM(?, ?, ?, ?, ?)',
			(string) Sfc::makePointZM(1, 3, 4, 8, 4326),
		);
	}
}
