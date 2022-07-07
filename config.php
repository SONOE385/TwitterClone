<?php
// PHPのミスがあったとき、エラー表示あり設定
ini_set('display_errors',1);
//日本時間にする
date_default_timezone_set('Asia/Tokyo');
//URLを定数に置き換える
define('HOME_URL','/TwitterClone/');
//データベースの接続情報
define('DB_HOST','ec2-34-239-241-121.compute-1.amazonaws.com');
define('DB_USER','ngxphyikbayzyu');
define('DB_PASSWORD','a2e7419a1005cde7420ab8559e6824fa1c2085f0ca388ec0ac8ccbc94a29fea5');
define('DB_NAME','twitter_clone');

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