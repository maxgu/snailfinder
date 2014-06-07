<?php

namespace SnailfinderTest;

use Snailfinder\Filesystem;

class FilesystemTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var Filesystem 
     */
    private $filesystem;
    
    /**
     *
     * @var \Snailfinder\Adapter\Local 
     */
    private $adapterMock;
    
    public function setUp() {
        
        $this->adapterMock = $this->getMock(
                'Snailfinder\Adapter\Local', 
                array(), 
                array('/')
        );
        
        $this->filesystem = $this->getMock(
                'Snailfinder\Filesystem', 
                array('assertPresent', 'getStream'), 
                array($this->adapterMock)
        );
    }
    
    public function testReadStreamMustFillLocalVarStream() {
        
        $path = 'php5-fpm.slow.log';
        
        $this->adapterMock->expects($this->once())
            ->method('readStream')
            ->with($path)
            ->will($this->returnValue(array()));
        
        $this->filesystem->expects($this->once())
            ->method('assertPresent')
            ->with($path)
            ->will($this->returnValue(true));
        
        $stream = $this->filesystem->readStream($path);
        
        $this->assertAttributeEquals($stream, 'stream', $this->filesystem);
    }
    
    public function testReadStreamByLine() {
        
        $path = 'php5-fpm.slow.log';
        $someResource = 123;
        
        $this->adapterMock->expects($this->once())
            ->method('getLine')
            ->with($someResource)
            ->will($this->returnValue('asd-asd-asd-asd asd'));
        
        $this->filesystem->expects($this->once())
            ->method('getStream')
            ->will($this->returnValue($someResource));
        
        $line = $this->filesystem->readStreamByLine($path);
    }
}

