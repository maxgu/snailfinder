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
    
    public function testParse() {
        
        $path = dirname(__DIR__) . '/assets/php5-fpm.slow.log';
        
//        $this->filesystemMock->expects($this->once())
//            ->method('readStream')
//            ->with($path)
//            ->will($this->returnValue(false));
//        
//        $this->setExpectedException('RuntimeException');
        
        $this->processor->parse($path);
        
        $this->assertTrue(true);
    }
}

