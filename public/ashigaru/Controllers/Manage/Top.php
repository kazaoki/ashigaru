<?php

namespace App\Controllers\Manage;

class Top extends \App\Controllers\Base
{
	// 管理者画面トップページ
	public function index() {

		global $Ag;

		// ページスラッグ設定
		$page_slugs = ['top'];

		// テンプレート出力
		include __TEMPLATES_DIR__.'/manage/top/index.php';

		// 完了
		return;
	}
}
