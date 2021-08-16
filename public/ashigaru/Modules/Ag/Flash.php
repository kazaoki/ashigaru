<?php

namespace Ag;

/**
 * ref: https://kantaro-cgi.com/blog/php/simple-flash-message.html
 */


class Flash
{
	/**
	 * Flashメッセージ追加
	 *
	 * ex. \Ag\Flash::set('データの登録に成功しました。', 'primary');
	 *
	 * class = primary, success, warning, danger
	 * class ref: https://getuikit.com/docs/alert
	 */
	static public function set($message, $class='primary') {
		if(!@$_SESSION['flashes']) $_SESSION['flashes'] = [];
		return $_SESSION['flashes'][] = [
			'message' => $message,
			'class'   => $class,
		];
	}

	/**
	 * Flashメッセージ取得＆クリア
	 *
	 * ex. $flashes = \Ag\Flash::get();
	 * ex. foreach(\Ag\Flash::get() as list($flash_msssage, $add_class)) {...};
	 *
	 */
	static public function get() {
		$flashes = isset($_SESSION['flashes']) ? $_SESSION['flashes'] : null;
		unset($_SESSION['flashes']);
		return $flashes;
	}
}
