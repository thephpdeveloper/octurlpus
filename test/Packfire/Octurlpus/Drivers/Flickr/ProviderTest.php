<?php

namespace Packfire\Octurlpus\Drivers\Flickr;

/**
 * Test class for Provider.
 * Generated by PHPUnit on 2012-07-16 at 21:08:48.
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Packfire\Octurlpus\Drivers\Flickr\Provider
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Provider;
    }

    public function testProviderPeek()
    {
        $urls = array(
            'http://flickr.com/photos/bees/2362225867/' => true,
            'http://www.flickr.com/photos/bees/2362225867/' => true,
            'http://www.flickr.com/photos/potatojunkie/4518379530/' => true,
            'http://www.flickr.com/' => false,
            'http://www.youtube.com/' => false
        );

        foreach ($urls as $url => $result) {
            $this->object->set($url);
            $this->assertEquals($result, $this->object->peek());
        }
    }

    public function testProviderFetch()
    {
        $this->object->set('http://www.flickr.com/photos/potatojunkie/4518379530/');
        $this->object->peek();
        $data = $this->object->fetch();
        $this->assertNotEmpty($data);
        $this->assertEquals('Flickr', $data['provider_name']);
        $this->assertEquals('1.0', $data['version']);
        $this->assertEquals('photo', $data['type']);
    }
}
