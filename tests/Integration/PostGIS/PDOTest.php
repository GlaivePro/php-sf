<?php

namespace Janaseta\SF\Tests\Integration\PostGIS;

use Janaseta\SF\Expression;
use Janaseta\SF\PostGIS\Sfc;
use PDO;
use PHPUnit\Framework\TestCase;

class PDOTest extends TestCase
{
	protected \PDO $pdo;

	protected function setUp(): void
	{
		parent::setUp();

		$dsn = "pgsql:host=localhost;port=5432;dbname=sfa;";

		$this->pdo = new PDO($dsn, 'sfa', 'sfa', [
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

	protected function selectVal(Expression $expression)
	{
		$query = $this->pdo->prepare("SELECT $expression as value");
		$query->execute($expression->bindings);

		return $query->fetch()['value'];
	}
}
