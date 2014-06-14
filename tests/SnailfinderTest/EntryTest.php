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
        
        $this->entry->registerLine($line1);
        $this->entry->registerLine($line2);
        
        $this->assertAttributeContains($line1, 'lines', $this->entry);
        $this->assertAttributeContains($line2, 'lines', $this->entry);
        
    }
    
    public function testPreparingLineInRegisterLine() {
        
        $rawLine1 = '[0x0000000001d0acb8] getView() /var/www/proj/application/controller/site.php:171';
        $rawLine2 = '[0x0000000001d0dda0] processAction() /var/www/proj/application/controller.php:564';
        
        $line1 = 'getView() /var/www/proj/application/controller/site.php:171';
        $line2 = 'processAction() /var/www/proj/application/controller.php:564';
        
        $this->entry->registerLine($rawLine1);
        $this->entry->registerLine($rawLine2);
        
        $this->assertAttributeContains($line1, 'lines', $this->entry);
        $this->assertAttributeContains($line2, 'lines', $this->entry);
        
    }
    
    public function testSkippingEmptyLineInRegisterLine() {
        
        $rawLine1 = ' ';
        $rawLine2 = '[0x0000000001d0dda0] processAction() /var/www/proj/application/controller.php:564';
        $rawLine3 = PHP_EOL;
        
        $line2 = 'processAction() /var/www/proj/application/controller.php:564';
        
        $this->entry->registerLine($rawLine1);
        $this->entry->registerLine($rawLine2);
        $this->entry->registerLine($rawLine3);
        
        $this->assertAttributeContains($line2, 'lines', $this->entry);
        $this->assertAttributeNotContains(' ', 'lines', $this->entry);
        $this->assertAttributeNotContains(PHP_EOL, 'lines', $this->entry);
        $this->assertAttributeCount(1, 'lines', $this->entry);
        
    }
    
    public function testParseDateAndPidRegisterLine() {
        
        $someLines = array(
            "[27-May-2014 05:43:20]  [pool www] pid 19569\n",
            "script_filename = /var/www/proj/index.php\n",
            "[0x0000000001d17fc8] mysql_query() /var/www/proj/framework/classes/db/mysql.php:29\n",
            "[0x0000000001d17450] execute() /var/www/proj/framework/classes/db/driver.php:154\n",
            "[0x0000000001d17138] query() /var/www/proj/framework/classes/db/activerecord.php:366\n",
            "[0x0000000001d169a8] get() /var/www/proj/application/model.php:577\n",
            "\n",
        );
        
        foreach ($someLines as $line) {
            $this->entry->registerLine($line);
        }
        
        $this->assertAttributeCount(6, 'lines', $this->entry);
        $this->assertAttributeEquals('27-May-2014 05:43:20', 'date', $this->entry);
        $this->assertAttributeEquals('19569', 'pid', $this->entry);
        
    }
    
}

