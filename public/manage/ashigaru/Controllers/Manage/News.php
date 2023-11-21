<?php

namespace App\Controllers\Manage;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class News extends \App\Controllers\Base
{
	/**
	 * お知らせ一覧
	 * ---------------------------------------------------------------------------------------------
	 */
	public function index($cat_id=null, $page=1) {

		global $page_slugs;
		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// カテゴリロード
		$cats = \App\Models\NewsCategory::all();

		// クエリ用意
		$query = \App\Models\News::full(); // 管理画面のときは status=0 でも表示対象に。
		if($cat_id) $query->where('category_id', $cat_id);

		// ページング用意
		$pager = \AG::pager([
			'now'           => $page,
			'per'           => $Ag['config']['news']['items_per_page_at_manage'],
			'count'         => $query->count(),
			'links'         => 5,
			'href_template' => $cat_id
				? __MANAGE__.'/news/cat/'.$cat_id.'/page/%d/'
				: __MANAGE__.'/news/page/%d/'
		]);

		// クエリにページング適用
		$news = $query
			->take($Ag['config']['news']['items_per_page_at_manage'])
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

		global $page_slugs;
		global $router;
		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// カテゴリロード
		$cats = \App\Models\NewsCategory::all();

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

		global $page_slugs;
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

		global $page_slugs;
		global $router;
		global $Ag;
		global $Admin;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// CSRFトークン検証
		\AG::csrf_check();

		// お知らせセット
		try {
			// お知らせモデル用意
			$entry = @$_POST['entry_id']
				? \App\Models\News::full()->findOrFail(@$_POST['entry_id']) // 既存データの場合
				: new \App\Models\News() // 新規データの場合
			;

			// 入力中のお知らせデータで上書き
			$_POST['is_blank'] = @$_POST['is_blank']; // チェックしてないとキーが作成されず既存の値でfill↓されてしまうため
			if('POST'===$_SERVER['REQUEST_METHOD']) $entry->fill($_POST);

		} catch(ModelNotFoundException $e) { return $router->trigger404(); }

		// 記事タイプがPDF以外の場合はPDFファイルを削除する
		$pdf_delete = false;
		if('pdf'!==$entry->type) {
			$entry->pdf_filename = null;
			$pdf_delete = true;
		}

		try {
			// DB保存
			$entry->save();

			// PDF更新
			\AG::base64_submit(
				$entry->id,
				__UPLOADS_DIR__.'/news_pdf',
				@$_POST['pdf_base64'],
				$pdf_delete,
				'pdf'
			);
		} catch(ModelNotFoundException $e) { return $router->trigger404(); }

		// 一覧に飛ぶ
		\AG::flash_set(
			'「'.$entry->title.'」のお知らせを更新しました。'.
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

		global $page_slugs;
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

	/**
	 * PDFプレビュー（POSTで飛ばす必要あり）
	 * ---------------------------------------------------------------------------------------------
	 */
	public function pdf_preview() {

		global $page_slugs;
		global $router;
		global $Ag;

		// 新規アップロードPDFのプレビュー
		if(strlen($_POST['pdf_base64'])) {
			$pdf_data = base64_decode(str_replace('data:application/pdf;base64,', '', $_POST['pdf_base64']));
		}
		// アップ済みPDFのプレビュー
		else if ($_POST['id']){
			$pdf_file = __UPLOADS_DIR__.'/news_pdf/'.$_POST['id'].'.pdf';
			$pdf_data = file_get_contents($pdf_file);
		}

		// 出力
		header('Content-Type: application/pdf');
		header('Content-Length: '.strlen($pdf_data));
		header('Content-Disposition: inline; filename="'.$_POST['pdf_filename'].'"');
		echo $pdf_data;

		// 完了
		return;
	}
}
