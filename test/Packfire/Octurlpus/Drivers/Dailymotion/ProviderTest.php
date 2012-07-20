<?php

namespace Packfire\Octurlpus\Drivers\Dailymotion;

/**
 * Test class for Provider.
 * Generated by PHPUnit on 2012-07-16 at 21:08:48.
 */
class ProviderTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Packfire\Octurlpus\Drivers\Dailymotion\Provider
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Provider;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     * @covers Provider::peek
     */
    public function testProviderPeek(){
        $urls = array(
            'http://www.dailymotion.com/video/x5ioet_phoenix-mars-lander_tech' => true,
            'http://www.dailymotion.com/video/xs08d5_to-the-fringe-episode-1-the-joke_fun' => true,
            'http://www.dailymotion.com/video/xs9x7w_deadpool-comic-con-trailer_videogames' => true,
            'https://speakerdeck.com/u/edds/p/what-the-flash-photography-introduction' => false,
            'http://www.youtube.com/really?LBTdJHkAr5A' => false,
            'http://example.com' => false
        );
        
        foreach($urls as $url => $result){
            $this->object->set($url);
            $this->assertEquals($result, $this->object->peek());
        }
    }
    
    /**
     * @covers Provider::fetch
     */
    public function testProviderFetch(){
        $this->object->set('http://www.dailymotion.com/video/x5ioet_phoenix-mars-lander_tech');
        $this->object->peek();
        $data = $this->object->fetch();
        $this->assertNotEmpty($data);
        $this->assertEquals('Dailymotion', $data['provider_name']);
        $this->assertEquals('1.0', $data['version']);
        $this->assertEquals('video', $data['type']);
    }

}