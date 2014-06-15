<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

trait ErrorsAwareTrait {

    /**
     *
     * @var string
     */
    private $error;
    
    /**
     * 
     * @param string $message
     */
    public function setError($message) {
        $this->error = $message;
    }
    
    /**
     * 
     * @return string
     */
    public function getError() {
        return $this->error;
    }

}
