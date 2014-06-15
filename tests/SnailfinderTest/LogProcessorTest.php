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
        $someLines = array(
            "[27-May-2014 05:43:20]  [pool www] pid 19569\n",
            "script_filename = /var/www/proj/index.php\n",
            "[0x0000000001d17fc8] mysql_query() /var/www/proj/framework/classes/db/mysql.php:29\n",
            "[0x0000000001d17450] execute() /var/www/proj/framework/classes/db/driver.php:154\n",
            "[0x0000000001d17138] query() /var/www/proj/framework/classes/db/activerecord.php:366\n",
            "[0x0000000001d169a8] get() /var/www/proj/application/model.php:577\n",
            "\n",
            "[27-May-2014 05:43:20]  [pool www] pid 19571\n",
            "script_filename = /var/www/proj/index.php\n",
            "[0x0000000001d17fc8] mysql_query() /var/www/proj/framework/classes/db/mysql.php:29\n",
            "[0x0000000001d17450] execute() /var/www/proj/framework/classes/db/driver.php:154\n",
            "[0x0000000001d17138] query() /var/www/proj/framework/classes/db/activerecord.php:366\n",
            "[0x0000000001d169a8] get() /var/www/proj/application/model.php:577\n",
        );
        
        $this->filesystemMock->expects($this->once())
            ->method('has')
            ->with($path)
            ->will($this->returnValue(true));
        
        $this->filesystemMock->expects($this->once())
            ->method('readStream')
            ->with($path)
            ->will($this->returnValue($someResource));
        
        $callCount = 2;
        foreach ($someLines as $line) {
            $this->filesystemMock->expects($this->at($callCount))
                ->method('readStreamByLine')
                ->will($this->returnValue($line));
            $callCount++;
        }
        
        $this->filesystemMock->expects($this->at($callCount))
            ->method('readStreamByLine')
            ->will($this->returnValue(false));

        $result = $this->processor->parse($path);
        
        $this->assertInstanceOf('Snailfinder\EntryCollection', $result);
        $this->assertCount(2, $result);
        
        foreach ($result as $entry) {
            $this->assertInstanceOf('Snailfinder\Entry', $entry);
        }
    }
}

