<?php
// 共通ファイル app.php を読み込み
require_once('../app.php');

use App\Models\AuthUser;

// POSTリクエスト以外は処理しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO: ログインユーザチェック
$auth_user = AuthUser::checkLogin();
// var_dump($auth_user);
// exit;

// TODO: ユーザがいなかったらログイン画面にリダイレクト
if (empty($auth_user)) {
    // ログインしていない場合はログイン画面にリダイレクト
    header('Location: ../login/');
    exit;
}

// TODO: POSTデータを取得
// TODO: 投稿処理

// トップにリダイレクト
header('Location: ./');
exit;