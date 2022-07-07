<?php
// PHPのミスがあったとき、エラー表示あり設定
ini_set('display_errors',1);
//日本時間にする
date_default_timezone_set('Asia/Tokyo');
//URLを定数に置き換える
define('HOME_URL','/TwitterClone/');
//データベースの接続情報
define('DB_HOST',getenv('DB_HOST'));
define('DB_USER',getenv('DB_USER'));
define('DB_PASSWORD',getenv('DB_PASSWORD'));
define('DB_NAME',getenv('DB_DATABASE'));

//9 行目から下、getenv('DB_HOST')に変える



// ini_set('display_errors',1);
// date_default_timezone_set('Asia/Tokyo');
// define('HOME_URL','/TwitterClone/');
// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PASSWORD','');
// define('DB_NAME','twitter_clone');

//9 行目から下、getenv('DB_HOST')に変える

?>