<?php

namespace App\Controllers\Manage;

class Top
{
    // 管理者画面トップページ
    public function index() {

        global $Ag;

        // ページスラッグ設定
        $page_slugs = ['top'];

        // テンプレート出力
        include __TEMPLATES__.'/manage/index.php';

        // 完了
        return;
    }
}
