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

// ルーティング登録：管理者画面
$router->before('GET', '/system(/(?!login).*)?', '\App\Controllers\System\Login@not_logged_in');
$router->get('/system/', '\App\Controllers\System\Top@index');
$router->get('/system/login/', '\App\Controllers\System\Login@index');
$router->post('/system/login/', '\App\Controllers\System\Login@login');
$router->get('/system/report/', '\App\Controllers\System\Report@index');
$router->get('/system/logout/', '\App\Controllers\System\Login@logout');

// エラーページ登録
$router->set404('\App\Controllers\Error@notFound');

// ルーターオブジェクト返却
return $router;
