<?php
global $Ag;

// グローバル定義

// パス定義
define('__URL__', getenv('LAMPMAN_MODE') ? 'https://localhost' : '');
define('__BASE__', '');
define('__BASE_DIR__', __DIR__);
define('__TEMPLATES__', __DIR__.'/Templates');

// その他設定
$Ag['config'] =
[
    'site_title' => 'Ashigaru sample',
    'db' => [
        'driver'    => 'mysql',
        'host'      => 'main.db',
        'database'  => 'test',
        'username'  => 'test',
        'password'  => 'test',
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => '',
    ],
    'items_per_page' => 10,
];
