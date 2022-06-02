<?php

namespace TontonsB\SF\Tests;

use PHPUnit\Framework\TestCase;
use TontonsB\SF\Expression;

class ExpressionTest extends TestCase
{
	public function testInstantiation()
	{
		$expression = new Expression;

		$this->assertIsObject($expression);
	}
}
