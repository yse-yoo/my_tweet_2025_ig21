<?php
// 共通ファイル app.php を読み込み
require_once('../app.php');

use App\Models\AuthUser;
use App\Models\Tweet;

// POSTリクエスト以外は処理しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO: ログインユーザチェック
$auth_user = AuthUser::checkLogin();
// var_dump($auth_user);
// exit;

// TODO: POSTデータを取得
$posts = sanitize($_POST);
// var_dump($posts);
// exit;

// TODO: 投稿処理
$tweet = new Tweet();
$tweet->insert($auth_user['id'], $posts);

// トップにリダイレクト
header('Location: ./');
exit;