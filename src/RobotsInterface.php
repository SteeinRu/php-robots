<?php
namespace Steein\Robots;

use Closure;

interface RobotsInterface
{

    /**
     * Add a comment to the robots.txt.
     *
     * @param string|array $comment
     * @return RobotsInterface
     */
    public function comment(...$comment) : RobotsInterface;

    /**
     * Add a Host to the robots.txt.
     *
     * @param string $host
     * @return RobotsInterface
     */
    public function host($host) : RobotsInterface;

    /**
     * Add a disallow rule to the robots.txt.
     *
     * @param string|array $directories
     * @return RobotsInterface
     */
    public function disallow(...$directories) : RobotsInterface;

    /**
     * Add a allow rule to the robots.txt.
     *
     * @param string|array $directories
     * @return RobotsInterface
     */
    public function allow(...$directories) : RobotsInterface;

    /**
     * Add a User-agent to the robots.txt.
     *
     * @param string $userAgent
     * @return RobotsInterface
     */
    public function userAgent($userAgent) : RobotsInterface;

    /**
     * Add a Sitemap to the robots.txt.
     *
     * @param string|array $sitemap
     * @return RobotsInterface
     */
    public function sitemap($sitemap) : RobotsInterface;

    /**
     * Adding a separator to the robots.txt.
     *
     * @param int $num
     * @return RobotsInterface
     */
    public function spacer(int $num = 1) : RobotsInterface;

    /**
     * Perform a callback for each batch agent.
     *
     * @param callable| Closure $closure
     * @return RobotsInterface
     * @throws RobotsException
     */
    public function each(\Closure $closure) : RobotsInterface;

    /***
     *  Creates a file with the selected data
     *
     * @param string|null $path
     * @throws RobotsException
     *
     * @return void
     */
    public function create(string $path = "robots.txt");
}