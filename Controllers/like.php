<?php
////////////////////////////////////////////
//ライクコントローラー
////////////////////////////////////////////

//設定を読み込み
include_once '../config.php';
//便利な関数を読み込み
include_once '../util.php';
//いいね!データ操作モデルを読み込む
include_once '../Models/likes.php';

// ---------------------------------
//ログインチェック
// ---------------------------------
$user = getUserSession();

//ログインしていない場合、404エラー
if(!$user){
    header('HTTP/1.0 404 Not Found');
    exit;
}

//----------------------------------
//いいね!する
//----------------------------------
$like_id = null;
//tweet_idがPOSTされた場合
if(isset($_POST['tweet_id'])){
    $data = [
        'tweet_id' => $_POST['tweet_id'],//登録する内容をデータ変数にまとめる
        'user_id'=> $user['id'],//セッションに入っていたuser_id
    ];
    //いいね!登録
    $like_id = createLike($data);//createLike関数の戻り値は$like_id
}


//----------------------------------
//いいね!取り消し
//----------------------------------
//like_idがPOSTされた場合に取り消しをする
if(isset($_POST['like_id'])){
    $data = [
        'like_id' => $_POST['like_id'],
        'user_id' => $user['id'],
    ];
    //いいね!削除
    deleteLike($data);
}

//--------------------------------------
// JSON形式で結果を返却
//--------------------------------------

$response = [
    // 返却したいデータを配列に入れる
    'message' => 'successful',
    //いいね!したときに値が入る
    'like_id' => $like_id,
];

header('Content-type: application/json; charset=uft-8');
echo json_encode($response);
