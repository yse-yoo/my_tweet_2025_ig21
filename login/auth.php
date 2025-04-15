<?php
// 共通ファイル app.php を読み込み
require_once '../app.php';

// Userモデルをインポート
use App\Models\User;

// POSTリクエストでなければ何も表示しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO: セッションにPOSTデータを登録
$_SESSION[APP_KEY]['login'] = $_POST;

// 入力されたアカウント名とパスワードを取得
$account_name = $_POST['account_name'];
$password = $_POST['password'];
// var_dump($account_name, $password);
// exit;

// TODO: ユーザ認証: new User() で auth() を実行
$auth_user = [];
if ($account_name === 'user1') {
    $auth_user['id'] = 1; // 仮のユーザID
} else {
    $auth_user['id'] = null;
}

if (empty($auth_user['id'])) {
    // ログイン失敗時はログイン入力画面にリダイレクト
    header('Location: input.php');
    exit;
} else {
    // TODO: 認証成功時はセッションにユーザデータを保存
    // TODO: トップページにリダイレクト
    header('Location: ../home/');
    exit;
}