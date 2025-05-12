<?php
// 共通ファイル app.php を読み込み

use App\Models\Tweet;
use App\Models\AuthUser;

require_once('../app.php');

// POSTリクエスト以外は処理しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO: ログインユーザチェック
$auth_user = AuthUser::checkLogin();

// TODO: POSTデータを取得
$posts = sanitize($_POST);

// ログインユーザのIDと投稿のユーザIDが一致しない場合はログイン画面にリダイレクト
if ((int) $auth_user['id'] !== (int) $posts['user_id']) {
    header('Location: ../login/');
    exit;
}

// TODO: 削除処理
$tweet = new Tweet();
$tweet_id = $tweet->delete($posts['tweet_id']);

// トップにリダイレクト
header('Location: ./');
exit;