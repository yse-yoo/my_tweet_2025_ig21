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
// TODO: サニタイズ
$posts = sanitize($_POST);

// TODO: セッションの APP_KEY 下の regist にPOSTデータを保存
$_SESSION[APP_KEY]['regist'] = $posts;

// TODO: Userモデルでユーザ登録(insert)を実行
$user = new User();
$auth_user['id'] = $user->insert($posts);

// TODO: 仮のユーザIDを設定
if ($posts['account_name'] === 'user1') {
    $auth_user['id'] = 1; // 仮のユーザID
} else {
    $auth_user['id'] = null;
}

if (empty($auth_user['id'])) {
    // TODO: エラーを APP_KEY > errors > public セッションに保存
    $_SESSION[APP_KEY]['errors']['public'] = 'ユーザ登録に失敗しました。';
    // TODO: 入力画面(input.php)にリダイレクト
    header('Location: input.php');
    exit;
} else {
    // $_SESSION[APP_KEY]['auth_user'] = $auth_user;
    // header('Location: ../home/');
    // TODO: 登録成功の場合はログイン画面(login/)へリダイレクト
    header('Location: ../login/');
    exit;
}
