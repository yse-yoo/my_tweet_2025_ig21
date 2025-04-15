<?php
// 共通ファイル app.php を読み込み
require_once('../app.php');

// TODO: ユーザセッションの確認し、ログインしていない場合はログイン画面にリダイレクト

// TODO: セッションからユーザ情報を取得
$user = [];

// ユーザセッションの取得
// TODO: Tweet投稿一覧を取得
// ダミーデーター
$tweets = range(1, 5);
?>

<!DOCTYPE html>
<html lang="ja">

<!-- TODO: コンポーネント: components/head.php -->
<?php include COMPONENT_DIR . 'head.php' ?>

<body>

    <div class="flex">

        <header class="w-1/5 p-3 border-r min-h-screen">
            <!-- TODO: components/nav.php 読み込み -->
            <?php include COMPONENT_DIR . 'nav.php' ?>
        </header>

        <main class="w-4/5 pt-3">
            <div class="row">
                <!-- TODO: components/tweet_form.php 読み込み -->
                レイアウト（メインコンテンツ）
            </div>

            <? if ($tweets) : ?>
                <?php foreach ($tweets as $value): ?>
                    <div class="row">
                        <!-- TODO: components/tweet.php 読み込み -->
                    </div>
                <?php endforeach ?>
            <? endif ?>
        </main>
    </div>

</body>

</html>