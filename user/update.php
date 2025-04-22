<?php
require_once "../app.php";

use App\Models\AuthUser;
use App\Models\User;

$auth_user = AuthUser::checkLogin();

$posts = sanitize($_POST);
$user = new User();
$user->update($auth_user['id'], $posts);

// ユーザ情報をセッションに保存
$_SESSION[APP_KEY]['auth_user'] = $user->find($auth_user['id']);

// リダイレクト
header('Location: ./');