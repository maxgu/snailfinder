<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

use League\Flysystem\Filesystem as FlyFilesystem;

class Filesystem extends FlyFilesystem {
    
    private $stream;
    
    public function readStream($path) {
        $this->stream = parent::readStream($path);
        
        return $this->stream;
    }
    
    public function readStreamByLine() {
        return $this->adapter->getLine($this->getStream());
    }
    
    public function getStream() {
        return $this->stream;
    }
    
}
