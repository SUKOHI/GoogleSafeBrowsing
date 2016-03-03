<?php namespace Sukohi\GoogleSafeBrowsing\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleSafeBrowsing extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'google-safe-browsing'; }

}