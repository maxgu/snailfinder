<?php

namespace SnailfinderTest\Adapter;

use Snailfinder\Adapter\Local;

class LocalTest extends \PHPUnit_Framework_TestCase {
    
    private $assetsDir;
    
    public function setUp() {
        $this->assetsDir = dirname(dirname(dirname(__FILE__))) . '/assets';
    }
    
    public function testGetLine() {
        $localAdapter = new Local('/');
        
        $stream = $localAdapter->readStream($this->assetsDir . '/php5-fpm.slow.log');
        
        $line = $localAdapter->getLine($stream['stream']);
        
        $this->assertEquals("[27-May-2014 05:43:20]  [pool www] pid 19569\n", $line);
    }
    
}
