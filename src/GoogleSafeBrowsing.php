<?php namespace Sukohi\GoogleSafeBrowsing;

class GoogleSafeBrowsing {

	private $insecure_results = [];

	public function isSecure($url) {

		$this->insecure_results = [
			'phishing' => false,
			'malware' => false,
			'unwanted' => false
		];

		if(empty($url)) {

			abort(500, 'Incorrect URL.');

		}

		$url = $this->getCheckUrl($url);
		$body = file_get_contents($url);

		if($body != '') {

			$results = explode(',', $body);

			foreach (['phishing', 'malware', 'unwanted'] as $key) {

				if(in_array($key, $results)) {

					$this->insecure_results[$key] = true;

				}

			}

			return false;

		}

		return true;

	}

	public function isPhishing() {

		return $this->insecure_results['phishing'];

	}

	public function isMalware() {

		return $this->insecure_results['malware'];

	}

	public function isUnwanted() {

		return $this->insecure_results['unwanted'];

	}

	private function getApiKey() {

		$api_key = config('google_safe_browsing.api_key');

		if($api_key == 'YOUR-API-KEY' || empty($api_key)) {

			abort(500, 'Incorrect API Key. If you do not have a key, create the key in the Google Developers Console. ' .
							'https://code.google.com/apis/console/');

		}

		return config('google_safe_browsing.api_key');

	}

	private function getClient() {

		return config('google_safe_browsing.client');

	}

	private function getCheckUrl($url) {

		$api_key = $this->getApiKey();
		$client = $this->getClient();
		return 'https://sb-ssl.google.com/safebrowsing/api/lookup?client='.
					$client .'&key='. $api_key .'&appver=1.5.2&pver=3.1&url='. urlencode($url);

	}

}