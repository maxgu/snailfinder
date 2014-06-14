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
    
    private $pid;
    private $date;
    private $lines = array();
    
    public function getDate() {
        return $this->date;
    }
    
    public function getPid() {
        return $this->pid;
    }
    
    public function registerLine($line) {
        
        if ($this->firstLine($line)) {
            $this->parseDate($line);
            $this->parsePid($line);
        }
        
        if ($this->hasMemoryMark($line)) {
            $line = strstr($line, ' ');
        }
        
        $line = trim($line);
        
        if (empty($line)) {
            return;
        }
        
        $this->lines[] = $line;
    }
    
    private function firstLine($line) {
        return strpos($line, ' pid ') !== false;
    }
    
    private function hasMemoryMark($line) {
        return strpos($line, '[0x') !== false;
    }
    
    private function parseDate($line) {
        $date = strstr($line, '] ', true);
        $this->date = trim($date, '[');
    }
    
    private function parsePid($line) {
        $pid = strstr($line, ' pid ');
        $this->pid = (int)trim(str_replace('pid', '', $pid));
    }
    
}
