<?php

namespace GlaivePro\SF\Tests\Feature;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC;
use GlaivePro\SF\PostGIS;
use GlaivePro\SF\Sfc;

class SfcTest extends TestCase
{
	public function testDefaultDriver(): void
	{
		$sfc = new Sfc;

		$point = $sfc->pointFromWkb('binary');

		$this->assertEquals(
			'ST_PointFromWKB(?)',
			(string) $point,
		);
		$this->assertEquals(['binary'], $point->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $point);
		$this->assertInstanceOf(OGC\Point::class, $point);
		$this->assertNotInstanceOf(PostGIS\Point::class, $point);
	}

	public function testPostgisDriver(): void
	{
		$sfc = new Sfc('PostGIS');

		$point = $sfc->pointFromWkb('binary');

		$this->assertEquals(
			'ST_PointFromWKB(?)',
			(string) $point,
		);
		$this->assertEquals(['binary'], $point->bindings);
		$this->assertInstanceOf(Contracts\Point::class, $point);
		$this->assertInstanceOf(PostGIS\Point::class, $point);
		$this->assertNotInstanceOf(OGC\Point::class, $point);
	}
}
