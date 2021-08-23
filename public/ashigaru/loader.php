<?php

// Loads
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/Modules/AG.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

// session start
@session_start();
if(session_status()===PHP_SESSION_NONE) throw new \BadMethodCallException('Session is not active.');

// Database setup
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($Ag['config']['db']);
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
