<?php
namespace App\Controllers;

/**
 * エラーページコントローラ
 */
class Error
{
    // 404 not found
    public function notFound() {
        header('HTTP/1.1 404 Not Found');
        echo '404エラーですね';
        return;
    }
}
