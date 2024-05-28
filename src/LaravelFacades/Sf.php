<?php

namespace GlaivePro\SF\LaravelFacades;

use Illuminate\Support\Facades\Facade;

class Sf extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \GlaivePro\SF\Sf::class;
    }
}
