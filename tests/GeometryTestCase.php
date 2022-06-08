<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\OGC\Geometry;

class GeometryTestCase extends TestCase
{
	protected string $geomSql = 'geom';
	protected Geometry $geom;

	protected function setUp(): void
	{
		parent::setUp();

		$this->geom = new Geometry($this->geomSql);
	}
}
