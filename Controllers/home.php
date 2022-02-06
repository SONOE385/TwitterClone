<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';
 

// TODO: ログインチェック(各画面でユーザーがログインしているか確認)
$user = getUserSession();
if(!$user){
    //$userに値がなければログインしていないということ
    header('Location:' .HOME_URL. 'Controllers/sign-in.php');
    exit;
}

//表示用の変数$view_userに$userを代入
$view_user = $user;

//ツイート一覧
//TODO:モデルから取得する
$view_tweets = [
    ['user_id'=>1,
     'user_name'=>'taro',
     'user_nickname'=>'太郎',
     'user_image_name'=>'sample-person.jpg',//アイコン画像
     'tweet_body'=>'今プログラミングをしています。',//つぶやき本文
     'tweet_image_name'=>null,//投稿画像。1件目は投稿がないのでnull
     'tweet_created_at'=>'2022-01-22 14:00:00',//投稿日時
     'like_id'=>null,//自分がいいねしていたら入ってくるid
     'like_count'=>0,//いいね数
    ],
      ['user_id'=>2,
      'user_name'=>'jiro',
      'user_nickname'=>'次郎',
      'user_image_name'=>null,//アイコン画像なし
      'tweet_body'=>'コワーキングスペースをオープンしました!',//つぶやき本文
      'tweet_image_name'=>'sample-post.jpg',
      'tweet_created_at'=>'2021-03-14 14:00:00',//投稿日時
      'like_id'=>1,//自分がいいねしていたら入ってくるid
      'like_count'=>1,//いいね数
      ]
];


 
// 画面表示
include_once '../Views/home.php';
?>