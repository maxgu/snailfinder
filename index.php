<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

include 'vendor/autoload.php';

use Phlyty\App;
use Snailfinder\ErrorHandler;
use Snailfinder\LogProcessor;
use Snailfinder\ReportBuilder;
use Snailfinder\PhpView;

$app = new App();

$errorHandler = new ErrorHandler();

$app->events()->attach('500', $errorHandler);
$app->events()->attach('501', $errorHandler);

$app->setView(new PhpView());

$app->get('/', function(App $app){
    $viewModel = array(
        'path' => '/var/log/php5-fpm.slow.log',
    );
    
    $app->render('index', $viewModel);
});

$app->get('/generate', function(App $app){
    
    $processor = new LogProcessor();
    $entries = $processor->parse($app->request()->getQuery('path'));
    
    $reportBuilder = new ReportBuilder();
    $reportBuilder->build($entries);
    
    $viewModel = array(
        'path' => $app->request()->getQuery('path', ''),
        'error' => $processor->getError()
    );
    
    $app->render('index', $viewModel);
});

$app->run();