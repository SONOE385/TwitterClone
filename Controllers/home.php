<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

//ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';
 

// ログインチェック(各画面でユーザーがログインしているか確認)
$user = getUserSession();
if(!$user){
    //$userに値がなければログインしていないということ
    header('Location:' .HOME_URL. 'Controllers/sign-in.php');
    exit;
}

//表示用の変数$view_userに$userを代入
$view_user = $user;

//ツイート一覧
//もともとはtaroとjiroのデータをいれていたところ。
$view_tweets = findTweets($user);
 
// 画面表示
include_once '../Views/home.php';
?>