<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

use Phlyty\AppEvent;

class ErrorHandler {
    
    public static function __invoke(AppEvent $app) {
        die(var_dump($app));
    }

}
