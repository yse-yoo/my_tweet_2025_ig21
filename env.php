<?php
// Database
// Docker
const DB_CONNECTION = 'mysql';
const DB_HOST = 'localhost';
const DB_PORT = 3306;
const DB_DATABASE = 'php_sns';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

// アプリキー（セッションキー兼用）
const APP_KEY = "php_sns";

// サイトタイトル
const SITE_TITLE = "My Tweet";

// サイトベースURL
define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));

// 個別で設定する場合
// const BASE_URL = "http://localhost/php_sns/";
// const BASE_URL = "http://localhost:8888/projects/php_mysql/php_sns/";