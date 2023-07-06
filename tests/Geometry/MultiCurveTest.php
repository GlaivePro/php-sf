<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Contracts;
use GlaivePro\SF\OGC\MultiCurve;
use GlaivePro\SF\OGC\MultiLineString;

class MultiCurveTest extends TestCase
{
	public function testMethodResults(): void
	{
		$mcurve = new MultiCurve('mcurve');

		$this->assertEquals(
			'ST_Length(mcurve)',
			(string) $mcurve->length(),
		);

		$this->assertEquals(
			'ST_IsClosed(mcurve)',
			(string) $mcurve->isClosed(),
		);
	}

	public function testClassExistenceAndTypes(): void
	{
		$this->assertInstanceOf(Contracts\MultiLineString::class, new MultiLineString('mlinestring'));
	}
}
