<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

use Phlyty\AppEvent;

class ErrorHandler {
    
    public static function __invoke(AppEvent $app) {
        /* @var $exception \Exception */
        $exception = $app->getParam('exception');
        
        echo $exception->getMessage() . '<br><hr>';
        echo '<pre>' . $exception->getTraceAsString() . '</pre>';
    }

}
