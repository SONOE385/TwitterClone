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
     'user_image_name'=>'sample-person.jpg',
     'tweet_body'=>'今プログラミングをしています。',
     'tweet_image_name'=>null,//投稿画像。1件目は投稿がないのでnull
     'tweet_created_at'=>'2022-01-22 14:00:00',//投稿日時
     'like_id'=>null,//自分がいいねしていたら入ってくるid
     'like_count'=>0,//いいね数
    ],
];
?>

<!DOCTYPE html>

<html lang="ja">
<head>
<?php include_once('../Views/common/head.php'); ?>
    
    <title>プロフィール画面 / Twitterクローン</title>
    <meta name="description" content="プロフィール画面です">
</head>
<body class="home profile text-center">
    <div class="container"><!--中身全体-->
    <?php include_once('../Views/common/side.php'); ?>
        <div class="main"><!--右サイドのつぶやきエリア-->
            <div class="main-header">
                <h1>太郎</h1>
            </div>
        <!---プロフィールエリア--->
        <div class="profile-area">
            <div class="top"><!--アイコン・編集ボタン-->
                <div class="user"><img src="<?php echo HOME_URL; ?>Views//img_uploaded/user/sample-person.jpg" alt=""></div>

                <?php if( isset($_GET['user_id']) ):?><!--URLの最後にuser_idがあれば-->
                    <!--相手のページ-->
                    <?php if( isset($_GET['case']) ): ?>
                        <button class="btn btn-sm">フォローを外す</button><!--user_idがあり、caseがあった場合は-->
                    <?php else: ?>
                        <button class="btn-sm btn-reverse">フォローする</button>
                    <?php endif; ?>
                <?php else: ?>
                    <!--自分のページ-->
                    <button class="tbn btn-reverse btn-sm" data-bs-toggle="modal" data-bs-target="#js-modal">プロフィール編集</button>
                <?php endif; ?>
                
                
                <!--ボタンを押したらモーダルが出てくるBootstrap-->
                <div class="modal fade" id="js-modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="profile.php" method="post" enctype="multipart/form-data"><!--画像も扱うのでenctypeも-->
                                <div class="modal-header">
                                    <h5 class="modal-title">プロフィールを編集</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="user">
                                        <img src="<?php echo HOME_URL; ?>Views//img_uploaded/user/sample-person.jpg" alt="">
                                    </div>
                                    <div class="mb-3"><!--アイコン画像のアップロードボタン-->
                                        <label for="" class="mb-1">プロフィール写真</label>
                                        <input type="file" class="form-control form-control-sm" name="image">
                                    </div>
                                    <input type="text" class="form-control mb-4" name="nickname" value="太郎" placeholder="ニックネーム" maxlength="50" required autofocus>
                                    <input type="text" class="form-control mb-4" name="name" value="taro" placeholder="ユーザー名" maxlength="50" required>
                                    <input type="email" class="form-control mb-4" name="email" value="taro@techis.jp" placeholder="メールアドレス" maxlength="254" required>
                                    <input type="password" class="form-control mb-4" name="password" value="" placeholder="パスワードを変更する場合ご入力ください" minlength="4" maxlength="128" required>
                                </div>
                                
                                <div class="modal-footer">
                                    <button class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
                                    <button class="btn" type="submit">保存する</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="name">太郎</div><!--ニックネーム-->
            <div class="text-muted">@taro</div><!--ユーザー名-->

            <div class="follow-follower"><!--フォロー数・フォロワー数-->
                <div class="follow-count">1</div>
                <div class="follow-text">フォロー中</div>
                <div class="follow-count">1</div><!--フォロワー数（クラス名同じでOK）-->
                <div class="follow-text">フォロワー</div>
            </div>
        </div>


        <!--仕切りエリア-->
        <div class="ditch"></div>
        
        <!--TODO:つぶやき一覧エリア-->
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