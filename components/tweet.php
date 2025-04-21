<div class="flex p-4 border-b border-gray-200">
    <!-- プロフィール画像 -->
    <div class="flex-shrink-0">
        <img src="images/me.png" alt="User Icon" class="rounded-full w-12 h-12">
    </div>
    <!-- ツイート本文 -->
    <div class="ml-4 flex-1">
        <!-- ユーザ情報 -->
        <div class="flex items-center">
            <span class="font-bold text-gray-900"><?= $value['account_name'] ?></span>
            <span class="ml-2 text-gray-500 text-sm"><?= $value['created_at'] ?></span>
        </div>
        <!-- ツイートテキスト -->
        <div class="mt-2 mb-2 text-gray-800">
            <?= nl2br($value['message']) ?>
        </div>
        <!-- ナビゲーション（アクション系アイコン） -->
        <nav class="mt-3 mb-3">
            <ul class="flex justify-start space-x-6">
                <li>
                    <a href="#" class="inline-flex items-center space-x-2">
                        <img src="svg/bubble.svg" class="w-4" alt="コメント">
                        <span class="text-gray-600 text-xs">333</span>
                    </a>
                </li>
                <li class="flex">
                    <a href="#" class="inline-flex items-center space-x-2">
                        <img src="svg/heart.svg" class="w-4" alt="いいね">
                        <span class="text-gray-600 text-xs">333</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="inline-flex items-center space-x-2">
                        <img src="svg/loop.svg" class="w-4" alt="リツイート">
                        <span class="text-gray-600 text-xs">333</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="inline-flex items-center space-x-2">
                        <img src="svg/trash.svg" class="w-4" alt="削除">
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>