<?php
/**
 * Plugin Name: nhrrob Movies
 * Description: A movie plugin using Laravel-style practices.
 * Version: 1.0
 * Author: Your Name
 */

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;

// Create an instance of the Laravel Container
$container = new Container;

// Set up the events dispatcher and router
$container->singleton('events', function () {
    return new Dispatcher;
});

$container->singleton('router', function ($container) {
    $router = new Router($container['events'], $container);
    require __DIR__ . '/app/Http/Routes.php';
    return $router;
});

// Boot the router
$container->make('router')->dispatch($container->make('request'));