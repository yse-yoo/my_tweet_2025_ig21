<?php
// 共通ファイル app.php を読み込み
require_once '../app.php';

// Userモデルをインポート
use App\Models\User;

// POSTリクエストでなければ何も表示しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}
// POSTデータ取得
$posts = $_POST;
// var_dump($posts);

// TODO: セッションの APP_KEY 下の regist にPOSTデータを保存
$_SESSION[APP_KEY]['regist'] = $posts;

// TODO: サニタイズ

// TODO: Userモデルでユーザ登録(insert)を実行
$auth_user = [];
// TODO: 仮のユーザIDを設定
if ($posts['account_name'] === 'user1') {
    $auth_user['id'] = 1; // 仮のユーザID
} else {
    $auth_user['id'] = null;
}

if (empty($auth_user['id'])) {
    // TODO: エラーを APP_KEY > errors > public セッションに保存
    // TODO: 入力画面(input.php)にリダイレクト
    header('Location: input.php');
    exit;
} else {
    // TODO: 登録成功の場合はログイン画面(login/)へリダイレクト
    header('Location: ../login/');
    exit;
}
