<?php 
use App\Models\User;
?>
<div class="p-4 border-b border-gray-200 hover:bg-gray-50 transition">
    <div class="flex">
        <!-- プロフィール画像 -->
        <div class="flex-shrink-0">
            <a href="user/?id=<?= $value['user_id'] ?>" class="block no-underline text-inherit">
                <img src="<?= User::profileImage($value['profile_image']) ?>" class="rounded-full w-12 h-12">
            </a>
        </div>

        <!-- ツイート全体（本文＋ツールバー） -->
        <div class="ml-4 flex-1">
            <!-- ユーザ情報 -->
            <div class="flex items-center">
                <a href="user/?id=<?= $value['user_id'] ?>" class="block no-underline text-inherit">
                    <span class="font-bold text-gray-900"><?= $value['display_name'] ?></span>
                </a>
                <span class="ml-2 text-gray-500">@<?= $value['account_name'] ?></span>
                <span class="ml-2 text-gray-500 text-sm"><?= $value['created_at'] ?></span>
            </div>

            <!-- ツイート本文リンク -->
            <a href="home/detail.php?id=<?= $value['id'] ?>" class="block no-underline text-inherit">
                <!-- メッセージ -->
                <div class="mt-2 mb-2 text-gray-800">
                    <?= nl2br(htmlspecialchars($value['message'])) ?>
                </div>

                <!-- アップロード画像 -->
                <?php if (File::has($value['image_path'])): ?>
                    <div class="mt-2">
                        <img src="<?= $value['image_path'] ?>" class="rounded-lg max-w-lg max-h-96 object-cover" alt="">
                    </div>
                <?php endif; ?>
            </a>

            <!-- アクションツールバー（折り返し） -->
            <div class="mt-3">
                <?php include COMPONENT_DIR . 'tweet_nav.php' ?>
            </div>
        </div>
    </div>
</div>