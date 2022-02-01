<?php
//設定関連を読み込む
include_once('../config.php');
//便利な関数
include_once('../util.php');

////////ツイート一覧エリアを動的にする/////////
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

?>

<!DOCTYPE html>
 <!--Githubトークン----ccd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 -->
<html lang="ja">
<head>
   <?php include_once('../Views/common/head.php'); ?>
    <title>検索画面 / Twitterクローン</title>
    <meta name="description" content="検索画面です">
</head>
<body class="home search text-center">
    <div class="container"><!--中身全体-->
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main"><!--右サイドのつぶやきエリア-->
            <div class="main-header">
            <h1>検索</h1></div>
        
        <!--検索エリア-->
        <form action="search.php" method="get">
            <div class="search-area">
                <input type="text" class="form-control" placeholder="キーワード検索" name="keyword" value="">
                <button type="submit" class="btn">検索</button>
            </div>
        </form>

        <!--仕切りエリア-->
        <div class="ditch"></div>

        <!--つぶやき一覧エリア-->
        <?php if(empty($view_tweets)) : ?><!---つぶやきがない場合の表示を作成--->
            <p class="p-3">ツイートがありません</p><!--p-3はpaddingのことで、全方向1remの余白をあける-->

        <?php else: ?><!--ここのelseから下のendifまで、データがあった場合-->
            <div class="tweet-list">
                <?php foreach($view_tweets as $view_tweet): ?>
            <?php include('../Views/common/tweet.php'); ?>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
 </body>
</html>