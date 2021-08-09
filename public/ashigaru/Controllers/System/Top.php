<?php

namespace App\Controllers\System;

use \RedBeanPHP\R;

class Top
{
    // 管理者画面トップページ
    public function index() {

        global $Ashigaru;
        global $router;

        // テンプレート出力
        include __TEMPLATES__.'/system/index.php';

        // 完了
        return;
    }
}
