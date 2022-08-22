<?php

namespace App\Controllers\Manage;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class News extends \App\Controllers\Base
{
	/**
	 * お知らせ一覧
	 * ---------------------------------------------------------------------------------------------
	 */
	public function index($page=1) {

		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// クエリ用意
		$news_query = \App\Models\News::full(); // 管理画面のときは status=0 でも表示対象に。

		// ページング用意
		$pager = \AG::pager([
			'now'           => $page,
			'per'           => $Ag['config']['manage']['items_per_page'],
			'count'         => $news_query->count(),
			'links'         => 5,
			'href_template' => __MANAGE__.'/news/page/%d/',
		]);

		// クエリにページング適用
		$news = $news_query
			->take($Ag['config']['manage']['items_per_page'])
			->skip($pager['offset'])
			->get()
		;

		// テンプレート出力
		include __TEMPLATES_DIR__.'/manage/news/index.php';

		// 完了
		return;
	}

	/**
	 * 編集画面
	 * ---------------------------------------------------------------------------------------------
	 */
	public function edit($entry_id=null) {

		global $router;
		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// エントリセット
		try {
			if(@$_POST['entry_id']) $entry_id = @$_POST['entry_id'];
			$entry = $entry_id
				? \App\Models\News::full()->findOrFail($entry_id) // 既存データの場合
				: new \App\Models\News() // 新規データの場合
			;

			// 確認画面からの戻り(POST)なら入力中のデータで上書き
			if('POST'===$_SERVER['REQUEST_METHOD']) $entry->fill($_POST);

		} catch(ModelNotFoundException $e) { return $router->trigger404(); }

		// テンプレート出力
		include __TEMPLATES_DIR__.'/manage/news/edit.php';

		// 完了
		return;
	}

	/**
	 * 確認画面
	 * ---------------------------------------------------------------------------------------------
	 */
	public function check() {

		global $router;
		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// エントリセット
		try {
			$entry = @$_POST['entry_id']
				? \App\Models\News::full()->findOrFail(@$_POST['entry_id']) // 既存データの場合
				: new \App\Models\News() // 新規データの場合
			;

			// 入力中のデータで上書き
			if('POST'===$_SERVER['REQUEST_METHOD']) $entry->fill($_POST);

		} catch(ModelNotFoundException $e) { return $router->trigger404(); }

		// テンプレート出力
		include __TEMPLATES_DIR__.'/manage/news/check.php';

		// 完了
		return;
	}

	/**
	 * データ保存
	 * ---------------------------------------------------------------------------------------------
	 */
	public function save() {

		global $router;
		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// CSRFトークン検証
		\AG::csrf_check();

		// エントリセット
		try {
			$entry = @$_POST['entry_id']
				? \App\Models\News::full()->findOrFail(@$_POST['entry_id']) // 既存データの場合
				: new \App\Models\News() // 新規データの場合
			;

			// 入力中のデータで上書き
			if('POST'===$_SERVER['REQUEST_METHOD']) $entry->fill($_POST);

		} catch(ModelNotFoundException $e) { return $router->trigger404(); }

		// DB保存
		$entry->save();

		// 一覧に飛ぶ
		\AG::flash_set(
			'「'.$entry->title.'」を保存しました。'.
				'<a href="'.__MANAGE__.'/news/edit/'.$entry->id.'/" class="uk-button uk-button-default uk-button-small uk-margin-left"><i class="fas fa-pen"></i> 編集する</a>'.
				($entry->status
					? '<a href="'.$entry->permalink.'" target="_blank" class="uk-button uk-button-default uk-button-small uk-margin-left"> <i class="fas fa-external-link-alt"></i> 公開ページを確認する</a>'
					: ''
				)
			,
		'success');
		echo header('Location: '.__MANAGE__.'/news/');

		// 完了
		return;
	}

	/**
	 * データ削除（POSTで飛ばす必要あり）
	 * ---------------------------------------------------------------------------------------------
	 */
	public function delete() {

		global $router;
		global $Ag;
		global $Admin;

		// CSRFトークン検証
		\AG::csrf_check();

		// エントリセット
		try {
			$entry = \App\Models\News::full()->findOrFail(@$_POST['entry_id']);
		} catch(ModelNotFoundException $e) { return $router->trigger404(); }

		// DBから削除
		$entry->delete();

		// 一覧に飛ぶ
		\AG::flash_set('「'.$entry->title.'」を削除しました。', 'success');
		echo header('Location: '.__MANAGE__.'/news'.(@$_POST['page'] ? '/page/'.$_POST['page'] : '').'/');

		// 完了
		return;
	}
}
