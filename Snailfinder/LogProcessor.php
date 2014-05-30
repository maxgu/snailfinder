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
use League\Flysystem\AdapterInterface;

class LogProcessor {
    
    /**
     *
     * @var string
     */
    private $path;
    
    /**
     *
     * @var AdapterInterface
     */
    private $filesystemAdapter;
    
    public function __construct($path) {
        $this->path = $path;
    }
    
    /**
     * Retrieve filesystem adapter instance
     *
     * If none present, lazy-loads League\Flysystem\Adapter\Local instance.
     *
     * @return AdapterInterface
     */
    public function getFilesystemAdapter() {
        if (!$this->filesystemAdapter instanceof AdapterInterface) {
            $this->setFilesystemAdapter(new Filesystem(new LocalAdapter($this->path)));
        }
        return $this->filesystemAdapter;
    }
    
    /**
     * Set filesystem adapter object
     *
     * @param  AdapterInterface $adapter
     * @return LogProcessor
     */
    public function setFilesystemAdapter(AdapterInterface $adapter){
        $this->filesystemAdapter = $adapter;
        return $this;
    }
    
}
