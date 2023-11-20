<?php

namespace App\Controllers\Manage;

class Login extends \App\Controllers\Base
{
	// 未ログインならフォームに飛ばす
	public function logged_in_check() {
		// 該当する管理者が見つからなければログイン画面へ
		if(!@$this->admin->id) {
			echo header('Location: '.__MANAGE__.'/login/');
			exit;
		}
	}

	// 管理者画面ログイン処理
	public function login() {

		// CSRFチェック
		\AG::csrf_check();

		// ID/PW認証
		$admin = \App\Models\Admin::where('login_id', @$_POST['login_id'])->first();

		// ログイン認証成功
		if($admin && password_verify(@$_POST['login_pw'], $admin->login_pw)) {

			// セッション記録
			$admin->login_sessions()->save(new \App\Models\LoginSession([
				'login_id'   => @$_POST['login_id'],
				'access_ip'  => \AG::access_ip(),
				'session_id' => session_id(),
			]));

			// ログイン中である記録をセッションに保存
			$_SESSION['loggedin_admin_id'] = $admin->login_id;

			// 管理画面トップへ移動
			echo header('Location: '.__MANAGE__);
			exit;
		}

		// ログイン認証失敗
		\AG::flash_set('ログイン認証に失敗しました。', 'danger');
		echo header('Location: '.__MANAGE__.'/login/');
	}

	// 管理者画面ログインページ
	public function index() {

		global $page_slugs;
		global $Ag;

		// ページスラッグ設定
		$page_slugs = ['login'];

		// すでにログイン中なら管理画面TOPに飛ばし
		if(@$_SESSION['loggedin_admin_id']) {
			echo header('Location: '.__MANAGE__);
			exit;
		}
		// ログイン画面出力
		include __TEMPLATES_DIR__.'/manage/login.php';
	}

	// 管理者画面ログアウト処理
	public function logout() {
		// セッションを破棄してログイン状態を終了する
		unset($_SESSION['loggedin_admin_id']);

		// ログアウト成功
		\AG::flash_set('ログアウトしました。', 'success');
		echo header('Location: '.__MANAGE__.'/login/');
		exit;
	}
}
