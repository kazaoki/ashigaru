<?php

/**
 * 出張ディスパッチャ
 * =============================================================================
 */

use Illuminate\Database\Eloquent\ModelNotFoundException;
require_once __DIR__.'/../manage/ashigaru/loader.php';

/**
 * ルーティング
 * -----------------------------------------------------------------------------
 */
$router = new \Bramus\Router\Router();
$router->set404('_404');
$router->get('/(?:cat\/([^\/]+))?\/?(?:page/(\d+))?', '_index');
$router->get('/entry/(\d+)/', '_detail');
$router->get('/pdf/(\d+)/', '_pdf');

/**
 * コントローラ
 * -----------------------------------------------------------------------------
 */

// カスタム404ページ
function _404() {
	header('HTTP/1.1 404 Not Found');
	include __DIR__.'/404.php';
}

// カスタム503ページ
function _503($set_messages) {
	global $messages;
	if(!is_array($set_messages)) $set_messages = [$set_messages];
	$messages = array_merge($messages ?: [], $set_messages);
	header('HTTP/1.1 503 Service Unavailable');
	include __DIR__.'/503.php';
}

// 一覧ページ
function _index($cat, $page) {
	global $router;
	global $Ag;

	// お知らせ一覧を取得
	try {
		// リスト取得用クエリ用意
		$query = \App\Models\News::query();
		if($cat) $query->whereRelation('category', 'slug', $cat);
			if($count = $query->count()) {

				// ページング
			$pager = \AG::pager([
				'now'       => $page,
				'per'       => $Ag['config']['news']['items_per_page'],
				'count'     => $count,
				'links'     => 5,
				'href_template' => __SITE__.'/news'.($cat ? '/cat/'.$cat : '').'/page/%d/',
			]);

			// リスト取得
			$posts = $query
				->take($Ag['config']['news']['items_per_page'])
				->skip($pager['offset'])
				->get()
			;
		}
	} catch(ModelNotFoundException $e){
		_503($e->getMessage());
		return;
	}

	// ページ出力
	include __DIR__.'/index.php';
}

// 詳細ページ
function _detail ($news_id) {

	global $router;
	global $Ag;

	// お知らせを取得
	try {
		$entry = \App\Models\News::findOrFail($news_id);
	} catch(ModelNotFoundException $e){
		_503($e->getMessage());
		return;
	} catch(Exception $e){
		_503($e->getMessage());
		return;
	}

	// ページ出力
	include __DIR__.'/detail.php';
}

// PDF出力
function _pdf ($news_id) {

	global $router;
	global $Ag;

	// お知らせを取得
	try {
		$entry = \App\Models\News::findOrFail($news_id);
	} catch(ModelNotFoundException $e){
		_503($e->getMessage());
		return;
	} catch(Exception $e){
		_503($e->getMessage());
		return;
	}

	// ファイルチェック
	if($entry->type!=='pdf' || !$entry->pdf_filename) {
		_503('正しくないデータが指定されました。');
		return;
	}

	// PDFの内容を出力
	$pdf_file = __UPLOADS_DIR__.'/news_pdf/'.$entry->id.'.pdf';
	if(!file_exists($pdf_file)) {
		_503('PDFファイル本体が見つかりませんでした。');
		return;
	}
	$pdf_data = file_get_contents($pdf_file);
	header('Content-Type: application/pdf');
	header('Content-Length: '.strlen($pdf_data));
	header('Content-Disposition: inline; filename="'.$entry->pdf_filename.'"');
	echo $pdf_data;


}

// ルーティング開始
$router->run();
