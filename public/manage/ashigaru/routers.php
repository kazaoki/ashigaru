<?php

// ルーターオブジェクト作成
global $router;
$router = new \Bramus\Router\Router();

// ※公開側のお知らせは出張ディスパッチャのためコメントアウト。全体をAshigaruにする場合はこちらに記述するか別ファイルにする。
// // -----------------------------------------------------------------------------
// // 公開画面
// // -----------------------------------------------------------------------------
// // トップページ
// $router->mount('', function() use ($router)
// {
// 	$router->get('/', '\App\Controllers\Top@index');
// 	$router->get('/name/(.+)', '\App\Controllers\Top@name');
// 	$router->get('/id/(\d+)', '\App\Controllers\Top@detail');
// });

// // お知らせ
// $router->mount('/news', function() use ($router)
// {
// 	$router->get('/?(?:cat/([^/]+))?/?(?:page/([^/]+))?', '\App\Controllers\News@index');
// 	$router->get('/entry/(\d+)/', '\App\Controllers\News@detail');
// 	$router->get('/pdf/(\d+)/', '\App\Controllers\News@pdf');
// });

// -----------------------------------------------------------------------------
// 管理画面
// -----------------------------------------------------------------------------
$router->mount('', function() use ($router)
{
	// ログイン済みか毎回チェック
	$router->before('GET|POST', '/', '\App\Controllers\Manage\Login@logged_in_check');
	$router->before('GET|POST', '/(?!login).*', '\App\Controllers\Manage\Login@logged_in_check');

	// ログイン回り
	$router->get('/login/', '\App\Controllers\Manage\Login@index');
	$router->post('/login/', '\App\Controllers\Manage\Login@login');
	$router->get('/logout/', '\App\Controllers\Manage\Login@logout');

	// トップ
	$router->get('', '\App\Controllers\Manage\Top@index');
	// $router->get('/', function(){ echo header('Location: '.__MANAGE__.'/news/'); }); // リダイレクト

	// お知らせ管理
	$router->mount('/news', function() use ($router) {
		$router->get('/?(?:/cat/(\d+))?(?:/page/(\d+))?', '\App\Controllers\Manage\News@index');
		$router->match('GET|POST', '/edit(?:/(\d+))?/', '\App\Controllers\Manage\News@edit');
		$router->post('/check/', '\App\Controllers\Manage\News@check');
		$router->post('/save/', '\App\Controllers\Manage\News@save');
		$router->post('/delete/', '\App\Controllers\Manage\News@delete');
		$router->post('/pdf_preview/', '\App\Controllers\Manage\News@pdf_preview');
	});
});

// -----------------------------------------------------------------------------
// エラー画面
// -----------------------------------------------------------------------------
// 404 Not Found
$router->set404('\App\Controllers\Manage\Error@notFound');

// ルーターオブジェクト返却
return $router;
