# Generator robots.txt
Generator robots.txt


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



## Testing

```
$ phpunit
```