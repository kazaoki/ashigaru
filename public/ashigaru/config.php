<?php
global $Ag;

// グローバル定義

// パス定義
define('__URL__', getenv('LAMPMAN_MODE') ? 'https://localhost' : 'https://example.jp');
define('__SITE__', '');
define('__SITE_DIR__', dirname(__DIR__));
define('__MANAGE__', __SITE__.'/manage');
define('__MANAGE_ASSETS__', __MANAGE__.'/assets');
define('__TEMPLATES_DIR__', __DIR__.'/Templates');

// define('__UPLOADS__', __SITE__.'/uploads');
// define('__UPLOADS_DIR__', __SITE_DIR__.'/uploads');

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

	// 公開画面設定
	'public' => [
		'items_per_page' => 10,
	],

	// 管理画面設定
	'manage' => [
		'items_per_page' => 3,
	],
];
