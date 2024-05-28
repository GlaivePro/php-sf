<?php

namespace GlaivePro\SF;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(
			Sf::class,
			fn (Application $app) => new Sf(
				$this->getDriverName($app['db']->getDriverName())
			),
		);

		$this->app->bind(
			Sfc::class,
			fn (Application $app) => new Sfc(
				$this->getDriverName($app['db']->getDriverName())
			),
		);
	}

	public function boot(): void
	{
		// Laravel does not support param bindings in many places, e.g.
		// $myModel->attr = 'unaccent(?)'; can't have bindings.
		// But Laravel provides a good value quoter.
		Expression::setQuoter($this->app['db']->escape(...));
	}

	protected function getDriverName(string $laravelDriverName): string
	{
		return match ($laravelDriverName) {
			'mariadb' => 'MariaDB',
			'mysql' => 'MySQL',
			'pgsql' => 'PostGIS',
			'sqlite' => 'SpatiaLite',
			default => 'OGC',
		};
	}
}
