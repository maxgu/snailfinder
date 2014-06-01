<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\FilesystemInterface;

class LogProcessor {
    
    /**
     *
     * @var FilesystemInterface
     */
    private $filesystem;
    
    /**
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
    
    public function parse($path) {
        $stream = $this->filesystem->readStream($path);
        
        if (!$stream) {
            return;
        }
        
        // TODO: for mocking this - need extends from Flysystem\Adapter\Local
        /*
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                echo $buffer;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
         */
    }
    
}
