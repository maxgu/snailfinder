<?php

namespace SnailfinderTest;

use Snailfinder\FilesystemAwareTrait;

class FilesystemAwareTraitDummyClass {
    use FilesystemAwareTrait;
}

class FilesystemAwareTraitTest extends \PHPUnit_Framework_TestCase {
    
    private $dummyClass;
    
    protected function setUp() {
        $this->dummyClass = new FilesystemAwareTraitDummyClass();
    }
    
    public function testGetFilesystemLazyLoad() {
        
        $filesystem = $this->dummyClass->getFilesystem();
        
        $this->assertInstanceOf('Snailfinder\Filesystem', $filesystem);
        $this->assertAttributeInstanceOf('Snailfinder\Filesystem', 'filesystem', $this->dummyClass);
    }
    
    public function testSetFilesystem() {
        
        $filesystemMock = $this->getMockBuilder('Snailfinder\Filesystem')
                ->disableOriginalConstructor()
                ->getMock();
        
        $this->dummyClass->setFilesystem($filesystemMock);
        
        $this->assertAttributeEquals($filesystemMock, 'filesystem', $this->dummyClass);
    }
    
}
