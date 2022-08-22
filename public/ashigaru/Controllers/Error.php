<?php
namespace App\Controllers;

/**
 * エラーページコントローラ
 */
class Error extends \App\Controllers\Base
{
	// 404 not found
	public function notFound() {
		header('HTTP/1.1 404 Not Found');
		include __TEMPLATES_DIR__.'/404.php';
		return;
	}
}
