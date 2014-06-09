<?php

namespace SnailfinderTest;

use Snailfinder\Entry;

class EntryTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var Entry
     */
    private $entry;
    
    public function setUp() {
        
        $this->entry = new Entry();
    }
    
    public function testLinesMustBeEmptyArray() {
        $this->assertAttributeEquals(array(), 'lines', $this->entry);
    }
    
    public function testRegisterLine() {
        
        $line1 = 'getView() /var/www/proj/application/controller/site.php:171';
        $line2 = 'processAction() /var/www/proj/application/controller.php:564';
        $line3 = 'processItem() /var/www/proj/application/controller.php:419';
        
        $this->entry->registerLine($line1);
        $this->entry->registerLine($line2);
        
        $this->assertAttributeContains($line1, 'lines', $this->entry);
        $this->assertAttributeContains($line2, 'lines', $this->entry);
        $this->assertAttributeNotContains($line3, 'lines', $this->entry);
        
    }
    
}

