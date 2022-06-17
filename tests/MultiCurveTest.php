<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\OGC\Contracts;
use TontonsB\SF\OGC\MultiCurve;
use TontonsB\SF\OGC\MultiLineString;

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
