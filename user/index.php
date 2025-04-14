<?php
require_once '../app.php';

// TODO: ユーザセッションの確認し、ログインしていない場合はログイン画面にリダイレクト

// TODO: セッションからユーザ情報を取得
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
            <div class="row">
                <h2 class="text-2xl mb-3 font-normal text-center">ユーザホーム</h2>
                <div class="mb-4">
                    <p class="text-center text-gray-700 text-md"><?= $user['account_name'] ?? '' ?>さん</p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>