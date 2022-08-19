<?php
global $Ag;

// グローバル定義

// パス定義
define('__URL__', getenv('LAMPMAN_MODE') ? 'https://localhost' : 'https://example.jp');
define('__BASE__', '');
define('__BASE_DIR__', dirname(__DIR__));
define('__TEMPLATES__', __DIR__.'/Templates');
// define('__UPLOADS__', __BASE__.'/uploads');
// define('__UPLOADS_DIR__', __BASE_DIR__.'/uploads');

// その他設定
$Ag['config'] =
[
    'system_title' => 'サンプルサイト 情報更新システム',
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
    // 'items_per_page' => 10,
];
