<?php
require_once "../app.php";

// TODO: セッションの APP_KEY 下の regist を削除
if (isset($_SESSION[APP_KEY]['user'])) {
    unset($_SESSION[APP_KEY]['user']);
}

// TODO: ログイン画面にリダイレクト