<?php

namespace SnailfinderTest;

use Snailfinder\LogProcessor;

class LogProcessorTest extends \PHPUnit_Framework_TestCase {
    
    private $path;
    private $processor;
    
    public function setUp() {
        $this->path = '/var/log/php-fpm.log';
        
        $this->processor = new LogProcessor($this->path);
    }
    
    public function testConstructor() {
        $this->assertAttributeEquals($this->path, 'path', $this->processor);
    }
    
    public function testPathCanbeReadable() {
        
    }
}

