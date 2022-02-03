<?php
///////////////////////////////////////
// ユーザーデータを処理
///////////////////////////////////////
 
/**
    * ユーザーを作成
    *
    * @param array $data
    * @return bool
    */

    function createUser(array $data){

        //DB接続。接続結果が$mysqlに入る。定義はconfig.phpにある。
        $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        //接続にエラーがあった場合、処理を停止
        if($mysqli->connect_errno){
            echo 'MySQLの接続に失敗しました。:'.$mysqli->connect_error."\n";
            exit;
        }

        //エラーなしのとき、新規登録のクエリを作成
        $query = 'INSERT INTO users (email,name,nickname,password) VALUES (?,?,?,?)';

        //プリペアドステートメントに、作成したクエリを登録
        $statement = $mysqli->prepare($query);

        //パスワードをハッシュ値（暗号化）に変換
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

        //クエリのプレースホルダーの部分にカラム値を紐づけ。ssss＝引数4つともstringにするという意味。
        $statement->bind_param('ssss',$data['email'],$data['name'],$data['nickname'],$data['password']);

        //クエリを実行
        $response = $statement->execute();

        //実行に失敗した場合=>エラーを表示
        if($response === false){
            echo 'エラーメッセージ:' .$mysqli->error."\n";
        }

        //DB接続を開放
        $statement->close();
        $mysqli->close();

        //SQLの実行結果を返す
        return $response;
    }
