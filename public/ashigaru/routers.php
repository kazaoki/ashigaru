<?php

/**
 * ルーター設定
 */

// ルーターオブジェクト作成
$router = new \Bramus\Router\Router();

// ルーティング登録：トップページ
$router->get('/', '\App\Controllers\Top@index');
$router->get('/name/(.+)', '\App\Controllers\Top@name');
$router->get('/id/(\d+)', '\App\Controllers\Top@detail');

// ルーティング登録：管理者画面：ログイン回り
$router->before('GET', '/manage(/(?!login).*)?', '\App\Controllers\Manage\Login@not_logged_in');
$router->get('/manage/login/', '\App\Controllers\Manage\Login@index');
$router->post('/manage/login/', '\App\Controllers\Manage\Login@login');
$router->get('/manage/logout/', '\App\Controllers\Manage\Login@logout');

// ルーティング登録：管理者画面：トップ
$router->get('/manage/', '\App\Controllers\Manage\Top@index');

// ルーティング登録：管理者画面：お知らせ
$router->get('/manage/news/', '\App\Controllers\Manage\News@index');

// エラーページ登録
$router->set404('\App\Controllers\Error@notFound');

// ルーターオブジェクト返却
return $router;
