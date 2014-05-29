<?php

/**
 * @link http://github.com/maxgu/snailfinder for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package snailfinder
 */

namespace Snailfinder;

use Phlyty\View\ViewInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class PhpView implements ViewInterface {
    
    public function render($template, $viewModel = [], $partials = null) {
        $renderer = new PhpRenderer();

        $stack = new Resolver\TemplatePathStack(array(
            'script_paths' => array(dirname(__DIR__) . '/templates')
        ));

        $resolver = new Resolver\AggregateResolver();

        $resolver->attach($stack);

        $renderer->setResolver($resolver);
        
        $layout = new ViewModel();
        $layout->setTemplate('layout/default.tpl');

        $content = new ViewModel();
        $content->setVariables($viewModel);
        $content->setTemplate($template . '.tpl');
        
        $layout->content = $renderer->render($content);
        
        return $renderer->render($layout);
    }
    
}
