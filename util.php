<?php
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

/**
    * ユーザー情報をセッションに保存
    *
    * @param array $user
    * @return void
    */
    function saveUserSession(array $user)
    {
        //セッションを開始していない場合。session_status()で現在のセッション状態をチェック
        if(session_status() === PHP_SESSION_NONE){
            //セッション開始
            session_start();
        }

        //セッションのUSERというキーの中に$user情報を格納
        //セッションに保存される
        $_SESSION['USER'] = $user;
    }

    /**
    * ユーザー情報をセッションから削除
    *
    * @return void
    */
    function deleteUserSession()
    {
        //セッションを開始していない場合
        if(session_status() === PHP_SESSION_NONE){
            //セッションを開始
            session_start();
        }

        //セッションのユーザー情報を削除。unset関数で削除できる
        unset($_SESSION['USER']);
    }

/**
 * セッションのユーザー情報を取得
 * 
 * @return array|false(trueならarray)
 */
function getUserSession()
{
    //セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE){
        //セッション開始
        session_start();
    }

    if(!isset($_SESSION['USER'])){
        //セッションにユーザー情報がない
        return false;
    }
    $user = $_SESSION['USER'];

    //画像のファイル名からファイルのURLを取得
    
        //画像ファイルがない場合
        if(!isset($user['image_name'])){
            $user['image_name']=null;
        }
    $user['image_path'] = buildImagePath($user['image_name'],'user');

    return $user;
}





?>