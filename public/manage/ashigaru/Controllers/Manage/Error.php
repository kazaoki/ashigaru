<?php
namespace App\Controllers\Manage;

/**
 * エラーページコントローラ
 */
class Error extends \App\Controllers\Base
{
	// 404 not found
	public function notFound() {
		global $page_slugs;
		header('HTTP/1.1 404 Not Found');
		$page_slugs = ['error'];
		include __TEMPLATES_DIR__.'/manage/error/404.php';
		return;
	}
}
