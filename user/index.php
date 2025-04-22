<?php
require_once '../app.php';

use App\Models\AuthUser;
use App\Models\User;

// TODO: ユーザセッションの確認し、ログインしていない場合はログイン画面にリダイレクト
// TODO: セッションからユーザ情報を取得
$auth_user = AuthUser::checkLogin();

$user = new User();
$user_data = $user->find($auth_user['id']);
?>

<!DOCTYPE html>
<html lang="ja">

<?php include COMPONENT_DIR . 'head.php' ?>

<body>
    <div class="flex">
        <header class="w-1/5 p-3 border-r min-h-screen">
            <?php include COMPONENT_DIR . 'nav.php' ?>
        </header>

        <main class="w-4/5 pt-3">
            <?php include COMPONENT_DIR . 'dashboard.php' ?>
        </main>
    </div>
</body>

</html>