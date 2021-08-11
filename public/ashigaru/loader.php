<?php

// Loads
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

// Uses
use \RedBeanPHP\R;

// session start
@session_start();
if(session_status()===PHP_SESSION_NONE) throw new \BadMethodCallException('Session is not active.');

// RedBean init
// R::setup();
R::setup('mysql:host=main.db;dbname=test', 'test', 'test');
R::freeze(TRUE);
