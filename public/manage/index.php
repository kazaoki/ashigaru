<?php

// loads
require_once __DIR__.'/ashigaru/loader.php';

// routing start
$router = require_once __DIR__.'/ashigaru/routers.php';
$router->run();
