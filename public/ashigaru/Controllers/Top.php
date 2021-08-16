<?php

namespace App\Controllers;

class Top
{
    // トップページコントローラ
    public function index() {

        // // 強制404
        // global $router;
        // $router->trigger404();
        // return;

        // テンプレート出力
        include __TEMPLATES__.'/index.php';

        // 完了
        return;
    }

    // test
    public function name($name) {

        //
        $post = R::dispense('post');
        $post->title = 'My holiday! name:'.$name;
        $id = R::store($post);

        var_dump($id);

        // テンプレート出力
        include __TEMPLATES__.'/index.php';

        // 完了
        return;
    }

    // detail
    public function detail($id) {

        //
        $post = R::load( 'post', $id );

        // テンプレート出力
        include __TEMPLATES__.'/detail.php';

        // 完了
        return;
    }
}
