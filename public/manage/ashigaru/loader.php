<?php

// Loads
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/Modules/AG.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

// session start
@session_start();
if(!@count(@array_filter(debug_backtrace(), function($caller){return in_array($caller['function'], ['include', 'include_once']);}))) {
	// 通常PHPからの include されている場合はセッションうまく開始できない場合があるのでその際はエラー無視
	if(session_status()===PHP_SESSION_NONE) throw new \BadMethodCallException('Session is not active.');
}

// Database setup
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($Ag['config']['db']);
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
