<?php

namespace GlaivePro\SF\Tests\MariaDB;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\Exceptions\MethodNotImplemented;
use GlaivePro\SF\MariaDB\Geometry;
use GlaivePro\SF\MariaDB\GeometryCollection;
use GlaivePro\SF\MariaDB\MultiCurve;
use GlaivePro\SF\MariaDB\MultiLineString;
use GlaivePro\SF\MariaDB\MultiPoint;
use GlaivePro\SF\MariaDB\MultiPolygon;
use GlaivePro\SF\MariaDB\Point;
use GlaivePro\SF\MariaDB\Sfc;
use GlaivePro\SF\MariaDB\Surface;

/**
 * Ensure that extending is correct.
 */
class ProxyTest extends TestCase
{
	/**
	 * Ensure that methods return instances of MariaDB classes.
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
	 * Ensure that the proxied methods create MariaDB objects
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

	public function testBdPolyFromTextNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdPolyFromText('text');
	}

	public function testBdMPolyFromWkbNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdMPolyFromWKB('binary');
	}

	public function testBdMPolyFromTextNotImplemented(): void
	{
		$this->expectException(MethodNotImplemented::class);
		Sfc::bdMPolyFromText('text');
	}
}
