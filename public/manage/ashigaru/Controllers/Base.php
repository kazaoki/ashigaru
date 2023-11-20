<?php
namespace App\Controllers;

/**
 * 基本コントローラ
 */
class Base
{
	// // ログイン中ならユーザーオブジェクトを格納
	// public ?\App\Models\User $user = null;

	// ログイン中なら管理者オブジェクトを格納
	public ?\App\Models\Admin $admin = null;

	// コンストラクタ
	public function __construct() {
		// ログインセッションがクッキーに残っている場合、DBに有効なセッションがあるかチェック

		// for 管理者
		if(strlen(@$_SESSION['loggedin_admin_id'])) {
			$query = \App\Models\LoginSession::query()
				->where('login_id', @$_SESSION['loggedin_admin_id'])
				->where('session_id', session_id())
			;
			if($query->count()) $this->admin = $query->first()->admin;
		}
		// // for ユーザー
		// if(strlen(@$_SESSION['loggedin_user_id'])) {
		// 	$query = \App\Models\LoginSession::query()
		// 		->where('login_id', @$_SESSION['loggedin_user_id'])
		// 		->where('session_id', session_id())
		// 	;
		// 	if($query->count()) $this->user = $query->first()->user;
		// }
	}
}
