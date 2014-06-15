<?php

namespace SnailfinderTest;

use Snailfinder\ErrorsAwareTrait;

class ErrorsAwareTraitDummyClass {
    use ErrorsAwareTrait;
}

class ErrorsAwareTraitTest extends \PHPUnit_Framework_TestCase {
    
    private $dummyClass;
    
    protected function setUp() {
        $this->dummyClass = new ErrorsAwareTraitDummyClass();
    }
    
    public function testGetErrorMustBeEmpty() {
        
        $error = $this->dummyClass->getError();
        
        $this->assertNull($error);
    }
    
    public function testSetErrorMustContainLastErrorMessage() {
        
        $message = 'error 2';
        
        $this->dummyClass->setError('error 1');
        $this->dummyClass->setError($message);
        
        $this->assertAttributeEquals($message, 'error', $this->dummyClass);
        $this->assertEquals($message, $this->dummyClass->getError());
    }
    
}
