<?php
require_once "env.php";

// セッション開始
session_start();
session_regenerate_id(true);

// アプリケーションのルートディレクトリパス
const BASE_DIR = __DIR__;
// app/ ディレクトリパス
const APP_DIR = __DIR__ . "/app/";
// lib/ ディレクトリパス
const LIB_DIR = __DIR__ . "/lib/";
// components/ ディレクトリパス
const COMPONENT_DIR = __DIR__ . "/components/";

// ライブラリ読み込み
require_once LIB_DIR . 'Database.php';
require_once LIB_DIR . 'Sanitize.php';

// モデルクラスの読み込み
require_once APP_DIR . 'models/User.php';