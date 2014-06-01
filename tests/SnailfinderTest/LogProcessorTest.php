<?php

namespace SnailfinderTest;

use Snailfinder\LogProcessor;

class LogProcessorTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var LogProcessor 
     */
    private $processor;
    
    /**
     *
     * @var \League\Flysystem\FilesystemInterface 
     */
    private $filesystemMock;
    
    public function setUp() {
        $this->filesystemMock = $this->getMock('League\Flysystem\FilesystemInterface');
        
        $this->processor = new LogProcessor();
        $this->processor->setFilesystem($this->filesystemMock);
    }
    
    public function testGetFilesystemLazyLoad() {
        
        $processor = new LogProcessor();
        
        $filesystem = $processor->getFilesystem();
        
        $this->assertInstanceOf('League\Flysystem\FilesystemInterface', $filesystem);
    }
    
    public function testSetFilesystem() {
        $this->assertAttributeEquals($this->filesystemMock, 'filesystem', $this->processor);
    }
    
    public function testParseReturnNullWhenFileNotOpened() {
        
        $path = dirname(__DIR__) . '/assets/php5-fpm.slow.log';
        
        $this->filesystemMock->expects($this->once())
            ->method('readStream')
            ->with($path)
            ->will($this->returnValue(false));
        
        $result = $this->processor->parse($path);
        
        $this->assertNull($result);
    }
    
    public function testParseWillReadLines() {
        
        $path = dirname(__DIR__) . '/assets/php5-fpm.slow.log';
        $someResource = 123;
        $someLine = "[27-May-2014 05:43:20]  [pool www] pid 19569\n";
        
        $this->filesystemMock->expects($this->once())
            ->method('readStream')
            ->with($path)
            ->will($this->returnValue($someResource));
        
        $this->filesystemMock->expects($this->any())
            ->method('getLine')
            ->will($this->returnValue($someLine));
        
        $result = $this->processor->parse($path);
        
        $this->assertNull($result);
    }
}

