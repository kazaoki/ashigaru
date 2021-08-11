<?php

namespace App\Controllers\System;

// use \RedBeanPHP\R;

class Login
{
    // 未ログインならフォームに飛ばす
    public function not_logged_in() {
        if(!@$_SESSION['loggedin']) {
            echo header('Location: '.__BASE_URL__.'/system/login/');
            exit;
        }
    }

    // 管理者画面ログイン処理
    public function login() {

        // CSRFチェック
        \Ag\Csrf::check();

        // パスワードチェック
        if('123456789'===@$_POST['login_pw']) $_SESSION['loggedin'] = 1;
        echo header('Location: '.__BASE_URL__.'/system/');
        exit;
    }

    // 管理者画面ログインページ
    public function index() {
        // すでにログイン中なら管理画面TOPに飛ばし
        if(@$_SESSION['loggedin']) {
            echo header('Location: '.__BASE_URL__.'/system/');
            exit;
        }
        // ログイン画面出力
        include __TEMPLATES__.'/system/login.php';
    }

    // 管理者画面ログアウト処理
    public function logout() {
        unset($_SESSION['loggedin']);
        echo header('Location: '.__BASE_URL__.'/system/login/');
        exit;
    }
}
