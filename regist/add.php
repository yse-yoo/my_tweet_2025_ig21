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

// TODO: セッションの APP_KEY 下の regist にPOSTデータを保存
$_SESSION[APP_KEY]['regist'] = $posts;

// TODO: サニタイズ

// TODO: Userモデルでユーザ登録(insert)を実行
$auth_user = [];
// TODO: 仮のユーザIDを設定
// $auth_user['id'] = 1; 

if (empty($auth_user['id'])) {
    // TODO: エラーを APP_KEY > errors > public セッションに保存
    // TODO: 入力画面(input.php)にリダイレクト
    exit;
} else {
    // TODO: 登録成功の場合は完了画面(login/)へリダイレクト
    exit;
}
