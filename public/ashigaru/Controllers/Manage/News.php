<?php

namespace App\Controllers\Manage;

class News
{
	// 管理者画面：お知らせTOP
	public function index() {

		global $Ag;

		// ページスラッグ設定
		$page_slugs = ['news'];

		// テンプレート出力
		include __TEMPLATES__.'/manage/news.php';

		// 完了
		return;
	}
}
