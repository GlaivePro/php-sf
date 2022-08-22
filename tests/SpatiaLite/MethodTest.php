<?php

namespace Janaseta\SF\Tests\SpatiaLite;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\SpatiaLite\Geometry;

/**
 * Ensure that methods use the dialect-specific syntax.
 */
class MethodTest extends TestCase
{
	public function testSetSrid(): void
	{
		$geom = new Geometry('geom');

		$setSRID = $geom->setSRID(4326);
		$this->assertEquals(
			'SetSRID(geom, ?)',
			(string) $setSRID,
		);
	}
}
