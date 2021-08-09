<?php

namespace App\Controllers\System;

use \RedBeanPHP\R;

class Report
{
    // 管理者画面：レポートTOP
    public function index() {

        global $Ashigaru;
        global $router;

        // テンプレート出力
        include __TEMPLATES__.'/system/report.php';

        // 完了
        return;
    }
}
