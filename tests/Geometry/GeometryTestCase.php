<?php

namespace GlaivePro\SF\Tests\Geometry;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\OGC\Geometry;

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
