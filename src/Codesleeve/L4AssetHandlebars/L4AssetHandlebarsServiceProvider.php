<?php namespace Codesleeve\L4AssetHandlebars;

use Illuminate\Support\ServiceProvider;

class L4AssetHandlebarsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$replace_once = 1;
		$project_base = $this->app['path.base'];

		$base = realpath(__DIR__ . '/../../../assets');
		$base = str_replace($project_base, '', $base, $replace_once);
		$base = ltrim($base, '/');

		\Event::listen('assets.register.paths', function($paths) use ($base) {
			$paths->add($base . '/javascripts', 'javascripts');
			$paths->add($base . '/stylesheets', 'stylesheets');
		});

		\Event::listen('assets.register.filters', function($filters) {
			$filters->add('.jst.hbs', array(
				new \Codesleeve\L4AssetHandlebars\Filters\HandlebarsFilter
			));
		});

		$this->package('codesleeve/l4-asset-handlebars');
		
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}