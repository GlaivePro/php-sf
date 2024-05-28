<?php

namespace GlaivePro\SF\Tests\Feature;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC;
use GlaivePro\SF\PostGIS;
use GlaivePro\SF\Sf;

class SfTest extends TestCase
{
	public function testDefaultDriver(): void
	{
		$sf = new Sf;

		$point = $sf->point('somecol');

		$this->assertEquals('somecol', (string) $point);
		$this->assertInstanceOf(Contracts\Point::class, $point);
		$this->assertInstanceOf(OGC\Point::class, $point);
		$this->assertNotInstanceOf(PostGIS\Point::class, $point);
	}

	public function testPostgisDriver(): void
	{
		$sf = new Sf('PostGIS');

		$point = $sf->point('somecol');

		$this->assertEquals('somecol', (string) $point);
		$this->assertInstanceOf(Contracts\Point::class, $point);
		$this->assertInstanceOf(PostGIS\Point::class, $point);
		$this->assertNotInstanceOf(OGC\Point::class, $point);
	}
}
