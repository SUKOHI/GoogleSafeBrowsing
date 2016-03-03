<?php namespace Sukohi\GoogleSafeBrowsing;

use Illuminate\Support\ServiceProvider;

class GoogleSafeBrowsingServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/config/google_safe_browsing.php' => config_path('google_safe_browsing.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['google-safe-browsing'] = $this->app->share(function($app)
		{
			return new GoogleSafeBrowsing;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['google-safe-browsing'];
	}

}