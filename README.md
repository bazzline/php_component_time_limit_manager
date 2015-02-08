# Time Limit Manager Component for PHP

This component helps you to validate if your script reaches the allowed maximum runtime.

Furthermore, you can set your own runtime limit (as long as it is below the limit in you php.ini).

The build status of the current master branch is tracked by Travis CI:
[![build status](https://travis-ci.org/bazzline/php_component_time_limit_manager.png?branch=master)](http://travis-ci.org/bazzline/php_component_time_limit_manager)
[![Latest stable](https://img.shields.io/packagist/v/net_bazzline/php_component_time_limit_manager.svg)](https://packagist.org/packages/net_bazzline/php_component_time_limit_manager)

The scrutinizer status are:
[![code quality](https://scrutinizer-ci.com/g/bazzline/php_component_time_limit_manager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_time_limit_manager/) | [![code coverage](https://scrutinizer-ci.com/g/bazzline/php_component_time_limit_manager/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_time_limit_manager/) | [![build status](https://scrutinizer-ci.com/g/bazzline/php_component_time_limit_manager/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bazzline/php_component_time_limit_manager/)

The versioneye status is:
[![dependencies](https://www.versioneye.com/user/projects/53e4ec98e0a229bcec00011c/badge.svg?style=flat)](https://www.versioneye.com/user/projects/53e4ec98e0a229bcec00011c)

Downloads:
[![Downloads this Month](https://img.shields.io/packagist/dm/net_bazzline/php_component_time_limit_manager.svg)](https://packagist.org/packages/net_bazzline/php_component_time_limit_manager)

It is also available at [openhub.net](http://www.openhub.net/p/718008).

# Benefits

* provides easy setting of runtime limit
* gives you the advantage to add a buffer before reaching the limit to easy up reacting when limit is reached
* helps you to set the limit in seconds, minutes or hours (same for the buffer)
* comes with [DependentInterface](https://github.com/bazzline/php_component_time_limit_manager/blob/master/source/Net/Bazzline/Component/TimeLimitManager/TimeLimitManagerDependentInterface.php) and [AwareInterface](https://github.com/bazzline/php_component_time_limit_manager/blob/master/source/Net/Bazzline/Component/TimeLimitManager/TimeLimitManagerAwareInterface.php)

# Examples

* [with reaching runtime limit](https://github.com/bazzline/php_component_time_limit_manager/blob/master/example/Example/withReachingLimit.php)
* [without reaching runtime limit](https://github.com/bazzline/php_component_time_limit_manager/blob/master/example/Example/withoutReachingLimit.php)

# Install

## By Hand

    mkdir -p vendor/net_bazzline/php_component_time_limit_manager
    cd vendor/net_bazzline/php_component_time_limit_manager
    git clone https://github.com/bazzline/php_component_time_limit_manager

## With [Packagist](https://packagist.org/packages/net_bazzline/php_component_time_limit_manager)

    composer require net_bazzline/php_component_time_limit_manager:dev-master

# Usage

```php
$manager = new Net\Bazzline\Component\TimeLimitManager\TimeLimitManager();
$manager->setBufferInSeconds(1);
$manager->setLimitInSeconds(4);

while (!empty($dataSet)) {
    if ($manager->isLimitReached()) {
        //exit while loop, shutdown process
    } else {
        $data = array_shift($dataSet);
        //work on data set
    }
}
```

# API

Thanks to [apigen](https://github.com/apigen/apigen), the api is available in the [document](https://github.com/bazzline/php_component_time_limit_manager/blob/master/document/index.html) section or [online](http://code.bazzline.net/).

# History

* upcomming
* [1.0.2](https://github.com/bazzline/php_component_time_limit_manager/tree/1.0.2) - released at 08.02.2015
    * updated dependencies
    * removed dependency to apigen
* [1.0.1](https://github.com/bazzline/php_component_time_limit_manager/tree/1.0.1) - released at 31.08.2014
    * add getRuntimeIn[Seconds|Minutes|Hours]
    * extended unit tests by covering setting of the buffer
    * added getter for minutes and hours
    * updated dependencies
* [1.0.0](https://github.com/bazzline/php_component_time_limit_manager/tree/1.0.0) - released at 27.07.2014
    * added examples, unit tests and api
* [0.0.1](https://github.com/bazzline/php_component_time_limit_manager/tree/0.0.1) - released at 27.07.2014
    * initial commit with stable api

# Future Improvements

* if you have one, create a feature request, fork it (and push it back :-))
