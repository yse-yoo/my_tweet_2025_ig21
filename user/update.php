<?php
require_once "../app.php";

use App\Models\AuthUser;
use App\Models\User;

// TODO: POSTリクエストの確認
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./');
    exit;
}

// ログインチェック
$auth_user = AuthUser::checkLogin();
if (!$auth_user) {
    header('Location: ./');
    exit;
}

// POSTデータの取得
$posts = sanitize($_POST);

// ユーザ情報の更新
$user = new User();
$user->update($auth_user['id'], $posts);

// ユーザ情報をセッションに保存
$_SESSION[APP_KEY]['auth_user'] = $user->find($auth_user['id']);

// リダイレクト
header('Location: ./');