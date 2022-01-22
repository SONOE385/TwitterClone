<?php
// PHPのミスがあったとき、エラー表示あり設定
ini_set('display_errors',1);
//日本時間にする
date_default_timezone_set('Asia/Tokyo');
//URLを定数に置き換える
define('HOME_URL','/TwitterClone/');

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

///////////////便利な関数//////////////////
/** 
* 画像ファイル名から画像のURLを生成する
*
* @param string $name （画像ファイル名）
* @param string $type user|tweet (アイコン画像か、投稿画像か識別する)
* @return string (URLを返すので、string(文字列)となる)
*/

function buildImagePath(string $name = null,string $type)//第1引数＝userが画像アップロードしてない可能性があるのでnullを許容
{//第1引数$name＝画像のURL・第2引数$type＝アイコン画像か、投稿画像か識別する
    if($type === 'user' && !isset($name)){//typeがユーザーで、ファイルが存在しない場合は
        return HOME_URL .'Views/img/icon-default-user.svg';//デフォルトのユーザー画像を返す
    }

    return HOME_URL . 'Views/img_uploaded/' . $type . '/' . htmlspecialchars($name);//画像ファイルがある場合のURL
}


/**
 * 指定した日時からどれだけ経過したかを取得
 *
 * @param string $datetime 日時
 * @return string
 */
function convertToDayTimeAgo(string $datetime)//string=文字列。文字列以外が入ったときにエラーになりミスに気づきやすい。最終的に
{//（続き）ここでいうforeach内の文字列'tweet_created_at'=>'2022-01-22 14:00:00'
    $unix = strtotime($datetime);//日時を$unixに変換。unix=1970年1月1日0時0分0秒から経過した秒数
    $now = time();//time関数は、unixの時刻開始から現在までの秒数を返す
    $diff_sec = $now - $unix;//現在日時 - 投稿日時で経過経過秒数を求める

    if($diff_sec < 60){
        $time = $diff_sec;
        $unit = '秒前';
    }elseif($diff_sec < 3600){
        $time = $diff_sec / 60;
        $unit = '分前';
    }elseif($diff_sec < 86400){
        $time = $diff_sec / 3600;
        $unit = '時間前';
    }elseif($diff_sec < 2764800){
        $time = $diff_sec / 86400;
        $unit = '日前';
    }else{
        if(date('Y') !== date('Y',$unix)){//現在の年と、投稿日の年が違う場合は
            $time = date('Y年n月j日',$unix);//年月日を返す。（第2引数をunixとすることで指定の形式で日時を返す）
        }else{
            $time = date('n月j日',$unix);//同じであれば月日を返す
        }
        return $time;
    }
    return (int)$time . $unit;//int=小数点切り捨て
}
?>

<!DOCTYPE html>
 <!--Githubトークン----ccd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 -->
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg"><!--ページタイトル先頭のアイコン-->
    <!-- Bootstrap--CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>ホーム画面 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>
<body class="home">
    <div class="container"><!--中身全体-->
        <div class="side"><!--左サイドのリンク全体-->
            <div class="side-inner"><!--サイドのインナークラス-->
                <ul class="nav flex-column"><!--Bootstrapのクラス（推奨）縦アイコン7個-->
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a>
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-home.svg" alt=""></a>   
                    <li class="nav-item"><a href="search.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-search.svg" alt=""></a>
                    <li class="nav-item"><a href="notification.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-notification.svg" alt=""></a>
                    <li class="nav-item"><a href="profile.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-profile.svg" alt=""></a>
                    <li class="nav-item"><a href="post.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a>
                    <li class="nav-item my-icon"><img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt=""></li>    
                </li>
                </ul>

            </div>        
        </div>
        <div class="main"><!--右サイドのつぶやきエリア-->
            <div class="main-header">
            <h1>ホーム</h1>
            </div>
        <!----つぶやき投稿エリア---アイコンとフォーム送信エリアに分ける-->
        <div class="tweet-post">
            <div class="my-icon">
                <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
            </div>
            <div class="input-area">
                <form action="post.php" method="post" enctype="multipart/form-data"><!--ファイルの送信がある場合enctypeがいる-->
                    <textarea name="body" placeholder="いまどうしてる？" maxlength="140"></textarea>
                    <div class="bottom-area">
                        <div class="mb-0"><!---ファイル送信エリア-->
                            <input type="file" name="image" class="form-control form-control-sm">
                        </div>
                        <button class="btn" type="submit">つぶやく</button>
                    </div>
                </form>
            </div>   
        </div>
        <!--仕切りエリア-->
        <div class="ditch"></div>

        <!--つぶやき一覧エリア-->
        <?php if(empty($view_tweets)) : ?><!---つぶやきがない場合の表示を作成--->
            <p class="p-3">ツイートがありません</p><!--p-3はpaddingのことで、全方向1remの余白をあける-->

        <?php else: ?><!--ここのelseから下のendifまで、データがあった場合-->
            <div class="tweet-list">
                <?php foreach($view_tweets as $view_tweet): ?>
            <div class="tweet">
                <div class="user"><!--自分の投稿-->
                    <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>"><!--自分のアイコンエリア-->
                        <img src="<?php echo buildImagePath( $view_tweet['user_image_name'],'user'); ?>" alt="">
                    </a>
                </div>
                <div class="content">
                    <div class="name"><!--ユーザー情報が入る-->
                        <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>">
                            <span class="nickname"><!--ニックネーム、ユーザー名、投稿日時から何日経過したか-->
                            <!--太郎--><?php echo htmlspecialchars($view_tweet['user_nickname']); ?>
                            </span>
                            <span class="user-name">@<!--taro--><?php echo htmlspecialchars($view_tweet['user_name']);?> ・

                            <?php echo convertToDayTimeAgo($view_tweet['tweet_created_at']);?></span>
                            
                        </a>
                    </div>
                        <p><!--今プログラミングをしています--><?php echo $view_tweet['tweet_body']; ?></p><!--投稿の内容-->
                        
                        <!--ifにすることで、画像を投稿してないのにimgタグが表示されるのを防ぐ。
                        issetで画像がある場合は表示させるという式-->
                        <?php if (isset($view_tweet['tweet_image_name'])):?>
                        <img src="<?php echo buildImagePath($view_tweet['tweet_image_name'],'tweet'); ?>" alt="" class="post-image"><!--投稿画像のimgを設置-->
                        <?php endif ?>
                        
                        <div class="icon-list"><!--いいねの♥といいねの数が入る-->
                            <div class="like">
                            <?php 
                            if (isset($view_tweet['like_id'])){//もし、like_idが存在していれば、青いハートを出す。isset関数
                                echo '<img src="' .HOME_URL. 'Views/img/icon-heart-twitterblue.svg" alt="">';
                            }
                            else{//like_idが何もなければ、グレーのハートを出す
                                echo '<img src="' .HOME_URL. 'Views/img/icon-heart.svg" alt="">';
                            }
                            ?>        
                            </div>
                            <div class="like-count"><!--0--><?php echo htmlspecialchars($view_tweet['like_count']); ?></div><!--いいね数-->
                        </div>
                </div>
            </div>

            
        <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div>
    </div>
 </body>
</html>