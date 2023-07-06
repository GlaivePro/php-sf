<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Point;

class PointTest extends TestCase
{
	public function testMethodResults(): void
	{
		$point = new Point('point');

		$this->assertEquals(
			'ST_X(point)',
			(string) $point->X(),
		);

		$this->assertEquals(
			'ST_Y(point)',
			(string) $point->Y(),
		);

		$this->assertEquals(
			'ST_Z(point)',
			(string) $point->Z(),
		);

		$this->assertEquals(
			'ST_M(point)',
			(string) $point->M(),
		);
	}
}
