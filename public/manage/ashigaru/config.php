<?php
global $Ag;

// グローバル定義

// パス定義
define('__URL__', getenv('LAMPMAN_MODE') ? 'https://localhost' : 'https://example.jp');
define('__SITE__', '');
define('__SITE_DIR__', dirname(__DIR__, 2));
define('__MANAGE__', __SITE__.'/manage');
define('__TEMPLATES_DIR__', __DIR__.'/Templates');
define('__INCLUDES_DIR__', __SITE_DIR__.'/includes');
define('__UPLOADS__', __SITE__.'/uploads');
define('__UPLOADS_DIR__', __SITE_DIR__.'/uploads');

// その他設定
$Ag['config'] =
[
	'site_title' => 'サンプルサイト',
	'system_title' => '情報更新システム',
	'db' => [
		'driver'    => 'mysql',
		'host'      => 'main.db',
		'database'  => 'test',
		'username'  => 'test',
		'password'  => 'test',
		'charset'   => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix'    => 'ag-',
	],

	// お知らせ設定
	'news' => [
		'items_per_page' => 5,
	],

	// 管理画面設定
	'manage' => [
		'items_per_page' => 3,
	],

    // 公開サイト設定
    'allow_image_ext'               => ['jpg', 'jpeg', 'png', 'gif'],
    'allow_pdf_ext'                 => ['pdf'],

    // 記事タイプラベル
    'entry_types' => [
        'entry' => '通常記事',
        'pdf'   => 'PDFファイル',
        'url'   => 'URLリンク',
    ]
];
