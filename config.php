<?php
// PHPのミスがあったとき、エラー表示あり設定
ini_set('display_errors',1);
//日本時間にする
date_default_timezone_set('Asia/Tokyo');
//URLを定数に置き換える
define('HOME_URL','/TwitterClone/');
//データベースの接続情報
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','twitter_clone');
?>