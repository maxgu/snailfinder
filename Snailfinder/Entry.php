<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

class Entry {
    
    private $lines = array();
    
    public function registerLine($line) {
        $this->lines[] = $line;
    }
    
}
