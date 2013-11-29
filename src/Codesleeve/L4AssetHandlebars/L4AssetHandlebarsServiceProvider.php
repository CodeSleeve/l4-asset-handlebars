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

		\Event::listen('asset.pipeline.boot', function($pipeline) use ($base) {
			$config = $pipeline->getConfig();

			$config['paths'][] = $base . '/javascripts';
			$config['paths'][] = $base . '/stylesheets';
			$config['mimes']['javascripts'][] = '.jst.hbs';
			$config['filters']['.jst.hbs'] = array(
				new Filters\HandlebarsFilter($config['paths'])
			);

			$pipeline->setConfig($config);
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