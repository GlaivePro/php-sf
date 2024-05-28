<?php

namespace GlaivePro\SF\LaravelFacades;

use Illuminate\Support\Facades\Facade;

class Sfc extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return \GlaivePro\SF\Sfc::class;
	}
}
