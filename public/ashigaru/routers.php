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

// エラーページ登録
$router->set404('\App\Controllers\Error@notFound');

// ルーターオブジェクト返却
return $router;
