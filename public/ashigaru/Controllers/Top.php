<?php

namespace App\Controllers;

class Top extends \App\Controllers\Base
{
	// トップページコントローラ
	public function index() {

		// // 強制404
		// global $router;
		// $router->trigger404();
		// return;

		// テンプレート出力
		include __TEMPLATES_DIR__.'/index.php';

		// 完了
		return;
	}

	// test
	public function name($name) {

		// テンプレート出力
		include __TEMPLATES_DIR__.'/index.php';

		// 完了
		return;
	}

	// detail
	public function detail($id) {

		// テンプレート出力
		include __TEMPLATES_DIR__.'/detail.php';

		// 完了
		return;
	}
}
