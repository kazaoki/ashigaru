<?php

namespace App\Controllers;

use \Illuminate\Database\Eloquent\ModelNotFoundException;

class News extends \App\Controllers\Base
{
	// お知らせ一覧
	public function index($cat=null, $page=1) {

		global $Ag;

		// お知らせ一覧を取得
		try {

			// リスト取得用クエリ用意
			$query = \App\Models\News::query();
			if($cat) $query->whereRelation('category', 'slug', $cat); // for Eloquent 8.x
			// if($cat) $query->whereHas('category', function($q) use($cat){ $q->where('slug', $cat); }); // for Eloquent 7.x

			// ページング
			$pager = \AG::pager([
				'now'       => $page,
				'per'       => $Ag['config']['public']['items_per_page'],
				'count'     => $query->count(),
				'links'     => 5,
				'href_template' => $cat
					? __SITE__.'/news/cat/'.urlencode($cat).'/page/%d/'
					: __SITE__.'/news/page/%d/'
			]);

			// リスト取得
			$posts = $query
				->take($Ag['config']['public']['items_per_page'])
				->skip($pager['offset'])
				->get()
			;

		} catch(ModelNotFoundException $e){
			global $router;
			$router->trigger404();
			return;
		}

		// ページ出力
		include __TEMPLATES_DIR__.'/news/index.php';

	}

	// お知らせ詳細
	public function detail($id) {

		global $router;
		global $message;

		// お知らせを取得
		try {
			$entry = \App\Models\News::findOrFail($id);
		} catch(ModelNotFoundException $e){
			$message = 'ご指定の記事が見つからないか公開待ちです。';
			$router->trigger404();
			return;
		}

		// ページ出力
		include __TEMPLATES_DIR__.'/news/detail.php';
	}

	// PDF出力
	public function pdf($id) {

		global $router;

		// お知らせを取得
		try {
			$news = \App\Models\News::findOrFail($id);
		} catch(ModelNotFoundException $e){
			$router->trigger404();
			return;
		} catch(\Exception $e){
			$router->trigger404();
			echo 'ご指定の記事が見つからないか公開待ちです。<br><a href="'.__SITE__.'/">トップページへ移動</a>';
			return;
		}

		// PDFの内容を出力
		$pdf_file = __UPLOADS_DIR__.'/news_pdf/'.$news->id.'.pdf';
		$pdf_data = file_get_contents($pdf_file);
		header('Content-Type: application/pdf');
		header('Content-Length: '.strlen($pdf_data));
		header('Content-Disposition: inline; filename="'.$news->pdf_filename.'"');
		echo $pdf_data;
	}
}
