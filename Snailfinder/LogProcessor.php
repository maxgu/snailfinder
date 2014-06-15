<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

class LogProcessor {
    
    use FilesystemAwareTrait;
    use ErrorsAwareTrait;
    
    public function parse($path) {
        
        if (empty($path)) {
            $this->setError("Path cannot be empty");
            return;
        }
        
        if (!$this->getFilesystem()->has($path)) {
            $this->setError("file '$path' not exists");
            return;
        }
        
        $stream = $this->getFilesystem()->readStream($path);
        
        if (!$stream) {
            $this->setError("file '$path' not exists or not readable");
            return;
        }
        
        $entries = $this->processLines($this->getFilesystem());
        
        return $entries;
    }
    
    private function processLines(Filesystem $filesystem) {
        $entry = new Entry();
        $entries = new EntryCollection(array($entry));
        while (($line = $filesystem->readStreamByLine()) !== false) {
            
            if ($line == PHP_EOL) {
                $entry = new Entry();
                $entries[] = $entry;
            }
            
            $entry->registerLine($line);
        }
        
        return $entries;
    }
}
