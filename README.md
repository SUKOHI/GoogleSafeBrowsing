GoogleSafeBrowsing
=====

A Laravel package to check if a specific URL is secure or not through Google Safe Browsing API.  
This package is inspired by [winternight/google-safe-browsing ](https://stash.treadstone.co/projects/PHPGSB/repos/main/browse).
(But unfortunately I couldn't install the package via composer.)  
(This is for Laravel 5+.)

Installation
====

Execute composer command.

    composer require sukohi/google-safe-browsing:2.*

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        Sukohi\GoogleSafeBrowsing\GoogleSafeBrowsingServiceProvider::class,
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'GoogleSafeBrowsing'   => Sukohi\GoogleSafeBrowsing\Facades\GoogleSafeBrowsing::class
    ]

Preparation
====

1.You need to get your API key for [Google Safe Browsing API](https://developers.google.com/safe-browsing/lookup_guide).  
2.Publish the config file.

    php artisan vendor:publish --force
    
3.Set your API key in `YOUR-APP/config/google_safe_browsing.php` like so.

    'api_key' => '*************************************'


Basic Usage
====

    if(GoogleSafeBrowsing::isSecure('https://github.com/SUKOHI')) {

        echo 'Secure!';

    }

Get more details
====

After calling isSecure('URL'), call a method you want like so.

    if(GoogleSafeBrowsing::isPhishing()) {

        echo 'This could be a phishing site!';

    }

    if(GoogleSafeBrowsing::isMalware()) {

        echo 'This could be a malicious software!';

    }

    if(GoogleSafeBrowsing::isUnwanted()) {

        echo 'This could be a unwanted site!';

    }


License
====

This package is licensed under the MIT License.

Copyright 2016 Sukohi Kuhoh