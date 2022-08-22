<?php

namespace Janaseta\SF\Tests\SpatiaLite;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\SpatiaLite\Geometry;
use Janaseta\SF\SpatiaLite\Point;
use Janaseta\SF\SpatiaLite\Sfc;

/**
 * Ensure that extending is correct.
 */
class ProxyTest extends TestCase
{
	public function testGeometry(): void
	{
		$geom = new Geometry('geom');

		$setSRID = $geom->setSRID(4326);
		$this->assertEquals(
			'SetSRID(geom, ?)',
			(string) $setSRID,
		);
		$this->assertEquals([4326], $setSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $setSRID);
	}

	/**
	 * Ensure that the proxied methods create SpatiaLite objects
	 */
	public function testProxiedConstructors(): void
	{
		$this->assertInstanceOf(Geometry::class, Sfc::geomFromText('text'));

		$this->assertInstanceOf(Point::class, Sfc::pointFromWKB('binary'));
	}
}
