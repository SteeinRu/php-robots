# Generator robots.txt
Generator of the text file "robots.txt" with support "Laravel"

***The robots.txt*** file is a text file located in the root directory of the site, in which special instructions for search robots are written. These instructions may prohibit some sections or pages on the site from being indexed, indicate the correct "mirroring" of the domain, recommend the search robot to observe a certain time interval between downloading documents from the server, etc.

## Installation
First, install the package via composer:
```
composer require steein/robots
```
Or add the following to your ```composer.json``` in the require section and then run ```composer``` update to install it.

```json
{
    "require": {
        "steein/robots": "dev-master"
    }
}
```

## Usage

### default

```php
use Steein\Robots\Robots;
use Steein\Robots\RobotsInterface;

Robots::getInstance()
    ->host("www.steein.ru")
    ->userAgent("*")
    ->allow("one","two")
    ->disallow("one","two","three")
    ->each(function (RobotsInterface $robots) {
        $robots->userAgent("Google")
            ->comment("Comment Google")
            ->spacer()
            ->allow("testing");
    })->each(function (RobotsInterface $robots) {
        $robots->userAgent("Bind")
            ->comment("Comment Bind")
            ->spacer()
            ->allow("testing");
    })->create(); // or render()

```

### support laravel

Once installed via Composer you need to add the service provider.
Do this by adding the following to the 'providers' section of the application config ```(usually config/app.php)```:

```php

// config/app.php
'providers' => [
    ...
    Steein\Robots\Laravel\RobotsServiceProvider::class,
    ...
];
```

This package also comes with a facade, which provides an easy way to call the the class.

```php
// config/app.php
'aliases' => [
    ...
    'Robots' => Steein\Robots\Laravel\RobotsFacade::class,
    ...
];
```

The quickest way to use Robots is to just setup a callback-style route for robots.txt in your ```routes/web.php``` file.

```php
Route::get('robots.txt', function() {

    $robots = RobotsFacade::host("www.steein.ru")
        ->userAgent("*")
        ->allow("one","two")
        ->disallow("one","two","three")
        ->each(function (RobotsInterface $robots) {
            $robots->userAgent("Bind")
                ->comment("Comment Bind")
                ->spacer()
                ->allow("testing");
        })->render();


    return Response::make($robots, 200, ['Content-Type' => 'text/plain']);
});
```



## Testing

```
$ phpunit
```