<?php

namespace GlaivePro\SF\Tests\PostGIS;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\PostGIS\Geometry;
use GlaivePro\SF\PostGIS\GeometryCollection;
use GlaivePro\SF\PostGIS\MultiCurve;
use GlaivePro\SF\PostGIS\MultiLineString;
use GlaivePro\SF\PostGIS\MultiPoint;
use GlaivePro\SF\PostGIS\MultiPolygon;
use GlaivePro\SF\PostGIS\Point;
use GlaivePro\SF\PostGIS\Sfc;
use GlaivePro\SF\PostGIS\Surface;

/**
 * Ensure that extending is correct.
 */
class ProxyTest extends TestCase
{
	/**
	 * Ensure that methods return instances of PostGIS classes.
	 */
	public function testTypes(): void
	{
		$geom = new Geometry('geom');

		$this->assertInstanceOf(
			Geometry::class,
			$geom,
		);

		$this->assertInstanceOf(
			Geometry::class,
			$geom->envelope(),
		);

		$this->assertInstanceOf(
			MultiCurve::class,
			(new Surface('surface'))->boundary(),
		);
	}

	/**
	 * Ensure that the proxied methods create PostGIS objects
	 */
	public function testProxiedConstructors(): void
	{
		$this->assertInstanceOf(Geometry::class, Sfc::geomFromText('text'));
		$this->assertInstanceOf(GeometryCollection::class, Sfc::geomCollFromText('text'));
		$this->assertInstanceOf(MultiPolygon::class, Sfc::mPolyFromText('text'));

		$this->assertInstanceOf(Point::class, Sfc::pointFromWKB('binary'));
		$this->assertInstanceOf(MultiPoint::class, Sfc::mPointFromWKB('binary'));
		$this->assertInstanceOf(MultiLineString::class, Sfc::mLineFromWKB('binary'));
	}

	public function testBdPolyFromWkbNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdPolyFromWKB('binary');
	}

	public function testBdMPolyFromWkbNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdMPolyFromWKB('binary');
	}
}
