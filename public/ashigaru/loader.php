<?php

/**
 * Loads
 */
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

use \RedBeanPHP\R;

/**
 * init
 */
// R::setup();
R::setup('mysql:host=main.db;dbname=test', 'test', 'test');
R::freeze(TRUE);
