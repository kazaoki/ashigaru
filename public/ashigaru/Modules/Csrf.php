<?php

namespace App\Modules;

class Csrf
{
    // CSRF生成
    public function make() {
        return 123;
    }

    // CSRF検証
    public function auth() {
        return true;
    }

    // CSRFリセット
    public function reset() {
        return;
    }
}
