<?php

// loads
require_once 'ashigaru/loader.php';

// routing start
$router = require_once 'ashigaru/routers.php';
$router->run();
