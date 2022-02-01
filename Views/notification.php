<?php
//設定関連を読み込む
include_once('../config.php');
//便利な関数
include_once('../util.php');

?>

<!DOCTYPE html>
 <!--Githubトークン----ccd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 -->
<html lang="ja">
<head>
   <?php include_once('../Views/common/head.php'); ?>
    <title>通知画面 / Twitterクローン</title>
    <meta name="description" content="通知画面です">
</head>
<body class="home notification text-center">
    <div class="container"><!--中身全体-->
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main"><!--右サイドのつぶやきエリア-->
            <div class="main-header">
            <h1>通知</h1>
            </div>
        
        <!--仕切りエリア-->
        <div class="ditch"></div>
        
        <!--通知エリア-->
        <div class="notification-list">
            <?php if( isset($_GET['case']) ):?>
                <p class="no-result">通知はまだありません。</p><!--パラメータにケースが入っていたら通知がないとする-->
            <?php else: ?>
                <div class="notification-item">
                    <div class="user"><!--アイコン-->
                        <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                    </div>
                    <div class="content">
                        <p>いいね!されました。</p>
                    </div>
                </div>

                <div class="notification-item">
                    <div class="user"><!--アイコン-->
                        <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                    </div>
                    <div class="content">
                        <p>フォローされました。</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
 </body>
</html>