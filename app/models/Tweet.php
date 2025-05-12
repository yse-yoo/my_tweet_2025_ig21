<?php

namespace App\Models;

use PDO;
use PDOException;
use Database;
use File;

class Tweet
{
    /**
     * コンストラクタ
     *
     * インスタンス生成時にプロパティ等の初期化が必要であれば行います。
     */
    public function __construct()
    {
        // 必要に応じた初期化処理を実装
    }

    /**
     * 投稿データを取得
     *
     * @return array|null 投稿データの連想配列、もしくは該当する投稿がなければ null
     */
    public function get($limit = 50)
    {
        try {
            $pdo = Database::getInstance();
            // 投稿データ取得SQL文
            // users テーブルと結合してユーザ名を取得
            // created_at を降順に並べ替え、 LIMITで件数制限
            $sql = "SELECT 
                    tweets.id,
                    tweets.message,
                    tweets.user_id,
                    tweets.image_path,
                    tweets.created_at,
                    tweets.updated_at,
                    users.account_name, 
                    users.display_name,
                    users.profile_image,
                    COUNT(likes.id) AS like_count 
                FROM tweets 
                JOIN users ON tweets.user_id = users.id
                LEFT JOIN likes ON tweets.id = likes.tweet_id
                GROUP BY 
                    tweets.id,
                    tweets.message,
                    tweets.user_id,
                    tweets.image_path,
                    tweets.created_at,
                    tweets.updated_at,
                    users.account_name, 
                    users.display_name,
                    users.profile_image
                ORDER BY tweets.created_at DESC 
                LIMIT :limit;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['limit' => $limit]);
            $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tweets;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo ($e->getMessage());
            return null;
        }
    }

    public function getByUserID($user_id, $limit = 50)
    {
        try {
            $pdo = Database::getInstance();
            // 投稿データ取得SQL文
            // users テーブルと結合してユーザ名を取得
            // created_at を降順に並べ替え、 LIMITで件数制限
            $sql = "SELECT 
                    tweets.id,
                    tweets.message,
                    tweets.user_id,
                    tweets.image_path,
                    tweets.created_at,
                    tweets.updated_at,
                    users.account_name, 
                    users.display_name,
                    users.profile_image,
                    COUNT(likes.id) AS like_count 
                FROM tweets 
                JOIN users ON tweets.user_id = users.id
                LEFT JOIN likes ON tweets.id = likes.tweet_id
                WHERE tweets.user_id LIKE :user_id
                GROUP BY 
                    tweets.id,
                    tweets.message,
                    tweets.user_id,
                    tweets.image_path,
                    tweets.created_at,
                    tweets.updated_at,
                    users.account_name, 
                    users.display_name,
                    users.profile_image
                ORDER BY tweets.created_at DESC 
                LIMIT :limit;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $user_id, 'limit' => $limit]);
            $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tweets;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo ($e->getMessage());
            return null;
        }
    }

    /**
     * キーワード検索して取得
     *
     * @return array|null 投稿データの連想配列、もしくは該当する投稿がなければ null
     */
    public function search($keyword, $limit = 50)
    {
        try {
            $pdo = Database::getInstance();
            $sql = "SELECT
                    tweets.id,
                    tweets.message,
                    tweets.user_id,
                    tweets.image_path,
                    tweets.created_at,
                    tweets.updated_at,
                    users.account_name,
                    users.display_name,
                    users.profile_image,
                    COUNT(likes.id) AS like_count
                FROM tweets
                LEFT JOIN likes ON tweets.id = likes.tweet_id
                LEFT JOIN users ON tweets.user_id = users.id
                WHERE tweets.message LIKE :keyword
                GROUP BY
                    tweets.id,
                    tweets.message,
                    tweets.user_id,
                    tweets.image_path,
                    tweets.created_at,
                    tweets.updated_at,
                    users.account_name,
                    users.display_name,
                    users.profile_image
                ORDER BY tweets.created_at DESC
                LIMIT :limit;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'keyword' => "%{$keyword}%",
                'limit' => $limit
            ]);
            $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tweets;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo ($e->getMessage());
            return null;
        }
    }

    /**
     * 投稿データを取得
     *
     * @param int $id 投稿ID
     * @return array|null 投稿データの連想配列、もしくは該当する投稿がなければ null
     */
    public function find(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = "SELECT * FROM tweets WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $value = $stmt->fetch(PDO::FETCH_ASSOC);
            return $value;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * 投稿データを取得
     *
     * @param int $id 投稿ID
     * @return array|null 投稿データの連想配列、もしくは該当する投稿がなければ null
     */
    public function findWithUser(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = "SELECT tweets.*, 
                            users.display_name, 
                            users.account_name,
                            users.profile_image
                    FROM tweets 
                    JOIN users ON tweets.user_id = users.id 
                    WHERE tweets.id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $value = $stmt->fetch(PDO::FETCH_ASSOC);
            return $value;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * ユーザデータをDBに登録する
     *
     * @param int $user_id ユーザID
     * @param array $data 登録する投稿データ
     * @return mixed 登録成功時は投稿ID、失敗時は null
     */
    public function insert($user_id, $data)
    {
        try {
            $data['user_id'] = $user_id;
            // 画像アップロード
            $data['image_path'] = $this->uploadImage();

            $pdo = Database::getInstance();
            $sql = "INSERT INTO tweets (user_id, message, image_path) 
                    VALUES (:user_id, :message, :image_path)";

            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute($data);
            if ($result) {
                return $pdo->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return;
    }

    /**
     * 投稿データを削除
     *
     * @param int $tweet_id 投稿ID
     * @return mixed 
     */
    public function delete(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = "DELETE FROM tweets WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return;
    }

    /**
     * 投稿データのカウント
     *
     * @param int $user_id ユーザID
     * @return mixed 
     */
    public function countByUserID($user_id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = "SELECT COUNT(*) FROM tweets WHERE user_id = :user_id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return;
    }

    /**
     * 画像データを取得
     * 
     * @return array|null 画像データの連想配列、もしくは該当する画像がなければ null
     */
    public function getImages()
    {
        $pdo = Database::getInstance();
        // 画像付きツイートのみ取得（新しい順） SQL
        $sql = "SELECT id, image_path FROM tweets 
                WHERE image_path IS NOT NULL AND image_path != '' 
                ORDER BY created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $images;
    }

    /**
     * アップロード画像を取得
     *
     * @param int $id 投稿ID
     * @return bool 成功した場合は画像ファイルパス、失敗した場合は null
     */
    public function uploadImage()
    {
        return File::upload(UPLOADS_BASE);
    }
}
