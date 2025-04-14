<?php

namespace App\Models;

use PDO;
use PDOException;
use Database;

class User
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
     * ユーザデータを取得
     *
     * @param int $id ユーザID
     * @return array|null ユーザデータの連想配列、もしくは該当するユーザがなければ null
     */
    public function find(int $id)
    {
        try {
            // DB接続
            $pdo = Database::getInstance();
            // SQL作成
            $sql = "SELECT * FROM users WHERE id = :id";
            // SQL事前準備
            $stmt = $pdo->prepare($sql);
            // プレースホルダー（:id）の値をバインドしてSQL実行
            $stmt->execute(['id' => $id]);
            // ユーザデータ取得
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // ユーザデータを連想配列として返す
            return $user;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * ユーザデータをDBに登録する
     *
     * @param array $data 登録するユーザデータ
     * @return mixed 登録成功時はユーザID、失敗時は null
     */
    public function insert($data)
    {
        try {
            // パスワードのハッシュ化
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            // DB接続
            $pdo = Database::getInstance();
            // INSERT用SQL（テーブル名やカラム名は適宜変更）
            $sql = "INSERT INTO users (account_name, email, display_name, password) 
                    VALUES (:account_name, :email, :display_name, :password)";
            // プリペアードステートメントの生成
            $stmt = $pdo->prepare($sql);
            // SQL実行（データ配列のキーとプレースホルダーは一致させる）
            $result = $stmt->execute($data);
            if ($result) {
                // 登録成功時は新規登録ユーザのIDを取得して返す
                return $pdo->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return;
    }

    /**
     * ユーザ認証
     *
     * @param string $account_name ユーザのアカウント名
     * @param string $password 入力されたパスワード
     * @return mixed 認証成功時はユーザデータの連想配列、失敗時はnull
     */
    public function auth($account_name, $password)
    {
        // DB接続
        $pdo = Database::getInstance();
        // SQL作成: アカウント名でユーザを検索
        $sql = "SELECT * FROM users WHERE account_name = :account_name";
        try {
            // プリペアードステートメントでSQLを実行
            $stmt = $pdo->prepare($sql);
            // プレースホルダー（:account_name）の値をバインドしてSQL実行
            $stmt->execute([':account_name' => $account_name]);
            // ユーザデータ取得
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // TODO: ユーザが存在し、password_verify() でパスワードの検証を実施
            // TODO: ユーザを返す
            return $user;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return;
    }

    public static function icon($id)
    {
        $iconFilePath = BASE_DIR . "/images/user_icon/{$id}.png";
        if ($id && file_exists($iconFilePath)) {
            return "/images/user_icon/{$id}.png";
        } else {
            return "/images/me.png";
        }
    }

}
