<?php

namespace Janaseta\SF\Tests\PostGIS;

use PHPUnit\Framework\TestCase;
use Janaseta\SF\Exceptions\MethodNotImplemented;
use Janaseta\SF\PostGIS\Geometry;
use Janaseta\SF\PostGIS\GeometryCollection;
use Janaseta\SF\PostGIS\MultiCurve;
use Janaseta\SF\PostGIS\MultiLineString;
use Janaseta\SF\PostGIS\MultiPoint;
use Janaseta\SF\PostGIS\MultiPolygon;
use Janaseta\SF\PostGIS\Point;
use Janaseta\SF\PostGIS\Sfc;
use Janaseta\SF\PostGIS\Surface;

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
