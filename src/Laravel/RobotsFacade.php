<?php
namespace Steein\Robots\Laravel;

use Illuminate\Support\Facades\Facade;
use Steein\Robots\RobotsException;


/**
 * @method static RobotsException each(\Closure $closure)
 * @method static RobotsException comment(...$comment)
 * @method static RobotsException host($host)
 * @method static RobotsException disallow(...$directories)
 * @method static RobotsException allow(...$directories)
 * @method static RobotsException userAgent($userAgent)
 * @method static RobotsException sitemap($sitemap)
 * @method static RobotsException spacer(int $num = 1)
 * @method static void create(string $path = "robots.txt")
 * @method static string render() : string
 *
 * @see \Steein\Robots\Robots
 */
class RobotsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'robots';
    }
}