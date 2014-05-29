<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

use Phlyty\App;

class Application {
    
    public static function __invoke(App $app) {
        $app->render('index', array('na' => 'ddd'));
    }

}
