<?php

namespace GlaivePro\SF\Tests\Integration\MariaDB;

use GlaivePro\SF\Expression;
use GlaivePro\SF\MariaDB\Geometry;
use GlaivePro\SF\MariaDB\Point;
use GlaivePro\SF\MariaDB\Sfc;
use PDO;
use PHPUnit\Framework\TestCase;

class PDOTest extends TestCase
{
	protected PDO $pdo;

	protected function setUp(): void
	{
		parent::setUp();

		$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=sfa;';

		$this->pdo = new PDO($dsn, 'sfa', 'sfa', options: [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]);
	}

	public function testConstructors(): void
	{
		$point = Sfc::point(23, 56, 4326);

		$this->assertEquals(23, $this->selectVal($point->x()));
		$this->assertEquals(56, $this->selectVal($point->y()));
		$this->assertEquals(4326, $this->selectVal($point->srid()));
	}

	/**
	 * Let's produce a triangular hull around some points and check whether
	 * other geometries are inside the hull.
	 */
	public function testComplexActions(): void
	{
		// Let's try various APIs
		$points = [
			Sfc::point(0, 0),
			new Point('POINT(?, ?)', [0, 10]),
			new Geometry("ST_GeomFromText('POINT(5 5)')"),
		];

		$hull = $points[0]->union($points[1])->union($points[2])->convexHull();

		$this->assertSame('POLYGON((0 0,0 10,5 5,0 0))', $this->selectVal($hull->asText()));

		$pointInside = Sfc::point(3, 5);
		$pointOutside = Sfc::point(10, 10);
		$this->assertEquals(1, $this->selectVal(
			$hull->contains($pointInside)
		));
		$this->assertEquals(1, $this->selectVal(
			$pointInside->within($hull)
		));
		$this->assertEquals(0, $this->selectVal(
			$hull->contains($pointOutside)
		));
		$this->assertEquals(0, $this->selectVal(
			$pointOutside->within($hull)
		));

		$line = Sfc::lineFromText('LINESTRING(3 3,10 10)');
		$this->assertEquals(0, $this->selectVal(
			$hull->contains($line)
		));
		$this->assertEquals(0, $this->selectVal(
			$line->within($hull)
		));
		$this->assertEquals(1, $this->selectVal(
			$hull->intersects($line)
		));
		$this->assertEquals(1, $this->selectVal(
			$line->intersects($hull)
		));
	}

	protected function selectVal(Expression $expression)
	{
		$query = $this->pdo->prepare("SELECT $expression as value");
		$query->execute($expression->bindings);

		return $query->fetch()['value'];
	}
}
