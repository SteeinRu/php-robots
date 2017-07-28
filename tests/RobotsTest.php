<?php
namespace Steein\Robots;

use PHPUnit\Framework\TestCase;

class RobotsTest extends TestCase
{
    public function testSitemap()
    {
        $robots  = new Robots();
        $sitemap = "sitemap.xml";
        $this->assertNotContains($sitemap, $robots->render());
        $robots->sitemap($sitemap);

        $this->assertContains("Sitemap: $sitemap", $robots->render());
    }

    public function testHost()
    {
        $robots = new Robots();
        $host   = "www.steein.ru";
        $this->assertNotContains("Host: $host", $robots->render());
        $robots->host($host);
        $this->assertContains("Host: $host", $robots->render());
    }

    public function testDisallow()
    {
        $robots = new Robots();
        $path = "dir";

        $this->assertNotContains($path,$robots->render());
        $robots->disallow($path);
        $this->assertContains($path, $robots->render());
    }

    public function testComment()
    {
        $robots    = new Robots();
        $comment_1 = "Steein comment";
        $comment_2 = "Test comment";
        $comment_3 = "Final test comment";

        $this->assertNotContains("# $comment_1", $robots->render());
        $this->assertNotContains("# $comment_2", $robots->render());
        $this->assertNotContains("# $comment_3", $robots->render());

        $robots->comment($comment_1);
        $this->assertContains("# $comment_1", $robots->render());

        $robots->comment($comment_2);
        $this->assertContains("# $comment_1", $robots->render());
        $this->assertContains("# $comment_2", $robots->render());

        $robots->comment($comment_3);
        $this->assertContains("# $comment_1", $robots->render());
        $this->assertContains("# $comment_2", $robots->render());
        $this->assertContains("# $comment_3", $robots->render());
    }

    public function testSpacer()
    {
        $robots = new Robots();

        $lines  = count(preg_split('/'. PHP_EOL .'/', $robots->render()));
        $this->assertEquals(1, $lines); // Starts off with at least one line.

        $robots->spacer();
        $lines = count(preg_split('/'. PHP_EOL .'/', $robots->render()));

        $this->assertEquals(2, $lines);
    }
}
