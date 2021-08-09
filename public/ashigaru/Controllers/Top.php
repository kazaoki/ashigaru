<?php

namespace App\Controllers;

use \RedBeanPHP\R;

class Top
{
    // トップページコントローラ
    public function index() {

        global $Ashigaru;
        global $router;

        // 強制404
        // $router->trigger404();
        // return;

        // test
        $photo1 = R::dispense('photos');
        $photo1->filename = 'AAA.jpg';
        $photo2 = R::dispense('photos');
        $photo2->filename = 'BBB.jpg';


        $post = R::dispense('post');
        $post->title = 'My holiday! (index)';
        $post->ownPhotoList[] = $photo1;
        $post->ownPhotoList[] = $photo2;
        $id = R::store($post);

        var_dump($id);



        // テンプレート出力
        include __TEMPLATES__.'/index.php';

        // 完了
        return;
    }

    // test
    public function name($name) {

        global $Ashigaru;
        global $router;

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

        global $Ashigaru;
        global $router;

        //
        $post = R::load( 'post', $id );

        // テンプレート出力
        include __TEMPLATES__.'/detail.php';

        // 完了
        return;
    }
}
