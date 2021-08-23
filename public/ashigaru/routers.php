<?php

// ルーターオブジェクト作成
global $router;
$router = new \Bramus\Router\Router();

/**
 * 管理画面ルーティング
 * -----------------------------------------------------------------------------
 */
// ログイン回り
$router->before('GET', '/manage(/(?!login).*)?', '\App\Controllers\Manage\Login@not_logged_in');
$router->get('/manage/login/', '\App\Controllers\Manage\Login@index');
$router->post('/manage/login/', '\App\Controllers\Manage\Login@login');
$router->get('/manage/logout/', '\App\Controllers\Manage\Login@logout');
// 管理画面トップ
$router->get('/manage/', '\App\Controllers\Manage\Top@index');
// お知らせ
$router->get('/manage/news/', '\App\Controllers\Manage\News@index');

/**
 * 公開画面ルーティング
 * -----------------------------------------------------------------------------
 */
// トップページ
$router->get('/', '\App\Controllers\Top@index');
$router->get('/name/(.+)', '\App\Controllers\Top@name');
$router->get('/id/(\d+)', '\App\Controllers\Top@detail');


/**
 * エラー画面ルーティング
 * -----------------------------------------------------------------------------
 */
// 404 Not Found
$router->set404('\App\Controllers\Error@notFound');

// ルーターオブジェクト返却
return $router;
