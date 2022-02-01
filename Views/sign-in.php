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

    
    <title>ログイン画面 / Twitterクローン</title>
    <meta name="description" content="ログイン画面です">
</head>
<body class="signup text-center"><!--text-center=Bootstrapのクラスでテキストを中央寄せにする-->
    <main class="form-signup">
        <form action="sign-in.php" method="post"><!--同ページ内にデータをPOSTする-->
            <img src="<?php echo HOME_URL; ?>Views//img/logo-white.svg" alt="" class="logo-white">
            <h1>Twitterクローンにログイン</h1><!--placeholder=背景文字、required=必須項目、autofocus=ページ表示の際に自動で選択されているように-->
            
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" required autofocus>
            <input type="password" class="form-control" name="password" placeholder="パスワード" required>
            <button class="w-100 btn btn-lg" type="submit">ログイン</button><!--w-100=widthが100、lg=大きなボタン-->
            <p class="mt-3 mb-2"><a href="sign-up.php">会員登録する</a></p>

            <p class="mt-2 mb-3 text-muted">&copy; 2021</p><!--text-muted=文字を灰色にする-->
        </form>
    </main>
    <?php include_once('../Views/common/foot.php'); ?>
</body>


</html>