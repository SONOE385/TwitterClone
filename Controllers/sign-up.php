<?php
///////////////////////////////////////
// サインアップコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込む
include_once '../util.php';
//モデルを読み込む。 会員登録をしたいので、usersテーブルを読み込み
include_once '../Models/users.php';
 
// 登録項目がすべて入力されていれば
if ( isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) ){
    $data = [
        'nickname' => $_POST['nickname'],//$dataという1つの配列にまとめる
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];

    // $data情報をもとにユーザーを作成し、成功すればModelsのusers.phpのSQL実行を読み込む->SQLデータがあれば
    if (createUser($data)) {
        // ログイン画面に遷移。header関数＝ブラウザに命令ができる。Location＝リンク先に遷移させる
        header('Location: '.HOME_URL.'Controllers/sign-in.php');
        exit;
    }
}
 
// ifを通らなければ、会員登録画面表示
include_once '../Views/sign-up.php';

//sign-up.phpを読み込んでいて、sign-up.phpがhead.phpを読み込んでいるから
//cssも反映される
?>