<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Curve;
use GlaivePro\SF\OGC\Point;

class CurveTest extends TestCase
{
	public function testMethodResults(): void
	{
		$curve = new Curve('curve');

		$this->assertEquals(
			'ST_Length(curve)',
			(string) $curve->length(),
		);

		$startPoint = $curve->startPoint();
		$this->assertEquals(
			'ST_StartPoint(curve)',
			(string) $startPoint,
		);
		$this->assertInstanceOf(Point::class, $startPoint);

		$endPoint = $curve->endPoint();
		$this->assertEquals(
			'ST_EndPoint(curve)',
			(string) $endPoint,
		);
		$this->assertInstanceOf(Point::class, $endPoint);

		$this->assertEquals(
			'ST_IsClosed(curve)',
			(string) $curve->isClosed(),
		);

		$this->assertEquals(
			'ST_IsRing(curve)',
			(string) $curve->isRing(),
		);
	}
}
