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
        $this->filesystemMock = $this->getMockBuilder('Snailfinder\Filesystem')
                ->disableOriginalConstructor()
                ->getMock();
        
        $this->processor = new LogProcessor();
        $this->processor->setFilesystem($this->filesystemMock);
    }
    
    public function testGetFilesystemLazyLoad() {
        
        $processor = new LogProcessor();
        
        $filesystem = $processor->getFilesystem();
        
        $this->assertInstanceOf('Snailfinder\Filesystem', $filesystem);
        $this->assertAttributeInstanceOf('Snailfinder\Adapter\Local', 'adapter', $filesystem);
    }
    
    public function testSetFilesystem() {
        $this->assertAttributeEquals($this->filesystemMock, 'filesystem', $this->processor);
    }
    
    public function testParseReturnNullWhenFileNotFound() {
        
        $path = 'php5-fpm.slow.log';
        
        $this->filesystemMock->expects($this->once())
            ->method('has')
            ->with($path)
            ->will($this->returnValue(false));
        
        $this->filesystemMock->expects($this->never())
            ->method('readStream');
        
        $result = $this->processor->parse($path);
        
        $this->assertNull($result);
        $this->assertNotEmpty($this->processor->getError());
    }
    
    public function testParseReturnNullWhenFileNotOpened() {
        
        $path = 'php5-fpm.slow.log';
        
        $this->filesystemMock->expects($this->once())
            ->method('has')
            ->with($path)
            ->will($this->returnValue(true));
        
        $this->filesystemMock->expects($this->once())
            ->method('readStream')
            ->with($path)
            ->will($this->returnValue(false));
        
        $this->filesystemMock->expects($this->never())
            ->method('readStreamByLine');
        
    
        $result = $this->processor->parse($path);
        
        $this->assertNull($result);
        $this->assertNotEmpty($this->processor->getError());
    }
    
    public function testParseWillReadLines() {
        
        $path = 'php5-fpm.slow.log';
        $someResource = 123;
        $someLine = "[27-May-2014 05:43:20]  [pool www] pid 19569\n";
        
        $this->filesystemMock->expects($this->once())
            ->method('has')
            ->with($path)
            ->will($this->returnValue(true));
        
        $this->filesystemMock->expects($this->once())
            ->method('readStream')
            ->with($path)
            ->will($this->returnValue($someResource));
        
        $this->filesystemMock->expects($this->at(2))
            ->method('readStreamByLine')
            ->will($this->returnValue($someLine));
        $this->filesystemMock->expects($this->at(3))
            ->method('readStreamByLine')
            ->will($this->returnValue(false));

        $result = $this->processor->parse($path);
        
        $this->assertNull($result);
    }
}

