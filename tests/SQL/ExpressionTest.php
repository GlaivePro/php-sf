<?php

namespace GlaivePro\SF\Tests\SQL;

use PHPUnit\Framework\TestCase;
use GlaivePro\SF\Exceptions\InvalidExpressionType;
use GlaivePro\SF\Expression;
use GlaivePro\SF\OGC\Geometry;

class ExpressionTest extends TestCase
{
	public function testConstructor(): void
	{
		$expression = new Expression('sql');

		$this->assertEquals('sql', $expression->sql);
		$this->assertEquals('sql', (string) $expression);
		$this->assertEquals([], $expression->bindings);
	}

	public function testWrapping(): void
	{
		$e = new Expression('sql');
		$ee = new Expression($e);

		$this->assertEquals('sql', $ee->sql);
		$this->assertEquals('sql', (string) $ee);
		$this->assertEquals([], $ee->bindings);
	}

	public function testConstructorWithBindings(): void
	{
		$expression = new Expression('sql', [1, 2]);

		$this->assertEquals('sql', $expression->sql);
		$this->assertEquals([1, 2], $expression->bindings);
	}

	public function testStringability(): void
	{
		$sql = 'somefun(?)';

		$expression = new Expression($sql, [3, 5]);

		$this->assertEquals($sql, (string) $expression);
	}

	public function testFactory(): void
	{
		$sql = 'somestatement';

		$expr = Expression::make($sql);
		$this->assertEquals($sql, (string) $expr);

		$expr2 = Expression::make($expr);
		$this->assertSame($expr, $expr2);

		$expr3 = Expression::make($sql);
		$this->assertNotSame($expr, $expr3);
		$this->assertEquals((string) $expr, (string) $expr3);
	}

	public function testFactoryTypes(): void
	{
		$sql = 'somestatement';

		$expr = Expression::make($sql);
		$this->assertInstanceOf(Expression::class, $expr);

		$geom = Geometry::make($sql);
		$this->assertInstanceOf(Geometry::class, $geom);

		// Same type is ok and returns object itself
		$expr2 = Expression::make($expr);
		$this->assertSame($expr, $expr2);

		$geom2 = Geometry::make($geom);
		$this->assertSame($geom, $geom2);

		// Subclasses are fine as well and returns object itself:
		// Every Geometry is still an Expression.
		$expr3 = Expression::make($geom);
		$this->assertSame($geom, $expr3);

		// Superclasses are not ok: not every Expression can be a Geometry.
		$this->expectException(InvalidExpressionType::class);
		Geometry::make($expr);
	}

	public function testMethodFactory(): void
	{
		$method = 'method';

		$rawArg = 'r1';

		$exprSql = 'expr(?, ?)';
		$exprBindings = ['a', 'b'];
		$exprWithBindings = new Expression($exprSql, $exprBindings);

		$geomSql = 'geom';
		$geomWithoutBindings = new Geometry($geomSql);

		$rawArg2 = 'r2';

		$expression = Expression::fromMethod(
			'method',
			$rawArg,
			$exprWithBindings,
			$geomWithoutBindings,
			$rawArg2,
		);

		$this->assertInstanceOf(Expression::class, $expression);
		$this->assertEquals("$method(?, $exprSql, $geomSql, ?)", (string) $expression);
		$this->assertEquals([
			$rawArg,
			...$exprBindings,
			$rawArg2,
		], $expression->bindings);
	}

	public function testMethodFactoryTypes(): void
	{
		// Any instance of Expression or subclass should always be acceptable
		// even on children.
		$expr = new Expression('expr');

		$geometry = Geometry::fromMethod('method', $expr);

		$this->assertInstanceOf(Geometry::class, $geometry);
		$this->assertEquals('method(expr)', (string) $geometry);
	}
}
