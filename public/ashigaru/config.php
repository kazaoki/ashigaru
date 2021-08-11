<?php
global $Ag;

// グローバル定義

// パス定義
define('__BASE__', 'https://localhost');
define('__BASE_DIR__', __DIR__);
define('__TEMPLATES__', __DIR__.'/Templates');

// その他設定
$Ag['config'] =
[
    'site_title' => 'Ashigaru sample',
    'db' => [
        'host' => '',
        'name' => '',
        'user' => '',
        'pass' => '',
    ],
    'items_per_page' => 10,
];
