<?php

// Loads
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

// session start
@session_start();
if(session_status()===PHP_SESSION_NONE) throw new \BadMethodCallException('Session is not active.');

// Database setup
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'main.db',
    'database'  => 'test',
    'username'  => 'test',
    'password'  => 'test',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
