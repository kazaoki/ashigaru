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

	// // お知らせ詳細
	// public function detail($id) {

	// 	// テンプレート出力
	// 	include __TEMPLATES_DIR__.'/detail.php';

	// 	// 完了
	// 	return;
	// }
}
