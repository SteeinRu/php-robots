<?php
namespace Steein\Robots;

use Closure;

class Robots implements RobotsInterface
{
    /**
     * The lines of for the robots.txt
     *
     * @var array
     */
    protected $linear   =   [
        //
    ];

    /**
     * Static instance of self
     *
     * @var Robots
     */
    protected static $_instance;

    /**
     * A method of returning the static instance to allow access to the
     * instantiated object from within another class.
     *
     * @uses $robots = Robots::getInstance();
     *
     * @return RobotsInterface
     */
    public static function getInstance() : RobotsInterface
    {
        if(self::$_instance === null) {
            self::$_instance = new static;
        }
        return self::$_instance;
    }

    /**
     * Construct
    */
    public function __construct()
    {
        //
    }

    /**
     * Perform a callback for each batch agent.
     *
     * @param callable|Closure $closure
     * @return RobotsInterface
     * @throws RobotsException
     */
    public function each(\Closure $closure) : RobotsInterface
    {
        if($closure instanceof \Closure) {
            $closure($this);
        }

        return $this;
    }
    /**
     * Add a comment to the robots.txt.
     *
     * @param string|array $comment
     * @return RobotsInterface
     */
    public function comment(...$comment) : RobotsInterface
    {
        $this->addLines($comment, "# ");
        return $this;
    }

    /**
     * Add a Host to the robots.txt.
     *
     * @param string $host
     * @return RobotsInterface
     */
    public function host($host) : RobotsInterface
    {
        $this->addLine("Host: $host");
        return $this;
    }

    /**
     * Add a disallow rule to the robots.txt.
     *
     * @param string|array $directories
     * @return RobotsInterface
     */
    public function disallow(...$directories) : RobotsInterface
    {
        $this->addRuleLine($directories, 'Disallow');

        return $this;
    }

    /**
     * Add a allow rule to the robots.txt.
     *
     * @param string|array $directories
     * @return RobotsInterface
     */
    public function allow(...$directories) : RobotsInterface
    {
        $this->addRuleLine($directories, 'Allow');

        return $this;
    }

    /**
     * Add a User-agent to the robots.txt.
     *
     * @param string $userAgent
     * @return RobotsInterface
     */
    public function userAgent($userAgent) : RobotsInterface
    {
        $this->addLine("User-agent: $userAgent");

        return $this;
    }

    /**
     * Add a Sitemap to the robots.txt.
     *
     * @param string|array $sitemap
     * @return RobotsInterface
     */
    public function sitemap($sitemap) : RobotsInterface
    {
        if(is_array($sitemap)) {
            $this->addLines($sitemap, "Sitemap: ");
        }else {
            $this->addLine("Sitemap: ".$sitemap);
        }
        return $this;
    }

    /**
     * Adding a separator to the robots.txt.
     *
     * @param int $num
     * @return RobotsInterface
     */
    public function spacer(int $num = 1) : RobotsInterface
    {
        for ($i = 0; $i <= $num; $i++) {
            $this->addLine(null);
        }

        return $this;
    }

    /***
     *  Creates a file with the selected data
     *
     * @param string|null $path
     * @throws RobotsException
     *
     * @return void
     */
    public function create(string $path = "robots.txt")
    {
        if($this->linear == null) {
            throw new RobotsException("There were errors while creating robots.txt");
        }elseif(!file_exists($path)) {
            file_put_contents($path,implode(PHP_EOL, $this->linear));
        }else {
            unlink($path);
            file_put_contents($path,implode(PHP_EOL, $this->linear));
        }
    }

    /***
     * Output of generated data to the robots.txt.
     *
     * @return string
    */
    public function render() : string
    {
        return implode(PHP_EOL, $this->linear);
    }

    /**
     * Adding a new rule to the robots.txt.
     *
     * @param string|array $directories
     * @param string       $rule
     */
    protected function addRuleLine($directories, $rule)
    {
        $this->isEmpty($directories);

        foreach ((array) $directories as $directory) {
            $this->addLine("$rule: $directory");
        }
    }

    /**
     * Adding a new line to the robots.txt.
     *
     * @param string $line
     */
    protected function addLine($line)
    {
        $this->linear[] = (string) $line;
    }

    /**
     * Adding multiple rows to the robots.txt.
     *
     * @param string|array $lines
     * @param null $prefix
     */
    protected function addLines($lines, $prefix = null)
    {
        $this->isEmpty($lines);

        foreach ((array) $lines as $line) {
            if($prefix != null) {
                $this->addLine($prefix.$line);
            }else {
                $this->addLine($line);
            }
        }
    }

    /***
     * Checking the data for existence
     *
     * @param null $var
     * @return void
     * @throws RobotsException
     */
    protected function isEmpty($var = null)
    {
        if($var == null) {
            throw new RobotsException("The parameter must not be empty");
        }
    }
}