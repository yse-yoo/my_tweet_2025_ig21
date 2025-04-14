<?php
// 共通ファイル app.php を読み込み
require_once('../app.php');

// POSTリクエスト以外は処理しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO: ログインユーザチェック
// TODO: ユーザがいなかったらログイン画面にリダイレクト
// TODO: POSTデータを取得
// TODO: 投稿処理

// トップにリダイレクト
header('Location: ./');
exit;