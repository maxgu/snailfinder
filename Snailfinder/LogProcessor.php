<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

use Snailfinder\Adapter\Local as LocalAdapter;
use League\Flysystem\FilesystemInterface;

class LogProcessor {
    
    /**
     *
     * @var FilesystemInterface
     */
    private $filesystem;
    
    private $error;
    
    /**$path
     * Retrieve filesystem adapter instance
     *
     * If none present, lazy-loads League\Flysystem\Adapter\Local instance.
     *
     * @return FilesystemInterface
     */
    public function getFilesystem() {
        if (!$this->filesystem instanceof FilesystemInterface) {
            $this->setFilesystem(new Filesystem(new LocalAdapter('/')));
        }
        return $this->filesystem;
    }
    
    /**
     * Set filesystem adapter object
     *
     * @param  FilesystemInterface $filesystem
     * @return LogProcessor
     */
    public function setFilesystem(FilesystemInterface $filesystem){
        $this->filesystem = $filesystem;
        return $this;
    }
    
    public function setError($message) {
        $this->error = $message;
    }
    
    public function getError() {
        return $this->error;
    }
    
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
