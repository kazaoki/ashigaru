<?php

namespace App\Controllers\Manage;

class Login
{
    // 未ログインならフォームに飛ばす
    public function not_logged_in() {
        if(!@$_SESSION['loggedin']) {
            echo header('Location: '.__BASE__.'/manage/login/');
            exit;
        }
    }

    // 管理者画面ログイン処理
    public function login() {

        // CSRFチェック
        \Ag\Csrf::check();

        // ID/PW認証
        $admin = \App\Models\Admin::where('login_id', @$_POST['login_id'])->first();

        // ログイン認証成功
        if(password_verify(@$_POST['login_pw'], $admin->login_pw)) {

            // セッション記録
            $admin->login_sessions()->save(new \App\Models\LoginSession([
                'login_id'   => @$_POST['login_id'],
                'access_ip'  => \Ag\AccessIp::get(),
                'session_id' => session_id(),
            ]));

            // ログイン中の情報を保存
            $_SESSION['loggedin'] = 1;

            // 管理画面トップへ移動
            echo header('Location: '.__BASE__.'/manage/');
            exit;
        }

        // ログイン認証失敗
        // \Ag::Flash('ログイン認証に失敗しました。', 'FAILED');
        echo header('Location: '.__BASE__.'/manage/login/');
    }

    // 管理者画面ログインページ
    public function index() {

        global $Ag;

        // ページスラッグ設定
        $page_slugs = ['login'];

        // すでにログイン中なら管理画面TOPに飛ばし
        if(@$_SESSION['loggedin']) {
            echo header('Location: '.__BASE__.'/manage/');
            exit;
        }
        // ログイン画面出力
        include __TEMPLATES__.'/manage/login.php';
    }

    // 管理者画面ログアウト処理
    public function logout() {
        unset($_SESSION['loggedin']);
        echo header('Location: '.__BASE__.'/manage/login/');
        exit;
    }
}
