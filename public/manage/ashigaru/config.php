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
	'site_title' => '〇〇〇〇〇〇〇〇様',
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

	// お知らせ管理設定
	'news' => [
		// 公開画面での一覧表示件数
		'items_per_page_at_public' => 5,

		// 管理画面での一覧表示件数
		'items_per_page_at_manage' => 5,

		// アップローダ許可形式：画像ファイル
		// 'allow_image_ext' => ['jpg', 'jpeg', 'png', 'gif'],

		// アップローダ許可形式：PDFファイル
		'allow_pdf_ext' => ['pdf'],

		// 記事タイプスラッグを表示ラベルに変換
		'type_labels' => [
			'entry' => '通常記事',
			'pdf'   => 'PDFファイル',
			'url'   => 'URLリンク',
		]
	],
];
