<?php
// 共通ファイル app.php を読み込み
require_once "../app.php";

if (isset($_SESSION[APP_KEY]['regist'])) {
    // TODO: セッション削除
}
header('Location: input.php');