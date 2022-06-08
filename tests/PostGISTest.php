<?php

namespace Tontonsb\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\PostGIS\Geometry;

class PostGISTest extends TestCase
{
	public function testGeometry(): void
	{
		$geom = new Geometry('geom');

		$setSRID = $geom->setSRID(4326);
		$this->assertEquals(
			'ST_SetSRID(geom, ?)',
			(string) $setSRID,
		);
		$this->assertEquals([4326], $setSRID->bindings);
		$this->assertInstanceOf(Geometry::class, $setSRID);
	}
}
