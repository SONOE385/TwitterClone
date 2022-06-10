<!DOCTYPE html>
 <!--Githubトークン----ccd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 -->
<html lang="ja">
<head>
   <?php include_once('../Views/common/head.php'); ?>
    <title>つぶやき画面 / Twitterクローン</title>
    <meta name="description" content="つぶやき画面です">
</head>
<body class="home">
    <div class="container"><!--中身全体-->
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main"><!--右サイドのつぶやきエリア-->
            <div class="main-header">
            <h1>つぶやく</h1>
            </div>
        <!----つぶやき投稿エリア---アイコンとフォーム送信エリアに分ける-->
        <div class="tweet-post">
            <div class="my-icon">
                <img src="<?php echo htmlspecialchars($view_user['image_path']); ?>" alt=""><!--セッションのユーザー情報から取得したイメージパスを読み込む-->
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

    </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
 </body>
</html>