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

    /**
     * ユーザー情報取得：ログインチェック
     * 
     * @param string $email
     * @param string $password
     * @return array|false どっちかが入る
     */
    function findUserAndCheckPassword(string $email,string $password)
    {
        //DB接続
        $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

            //接続エラーがある場合->処理停止
            if($mysqli->connect_errno){
                echo 'MySQLの接続に失敗しました。:'.$mysqli->connect_error."\n";
                exit;
            }

        //入力値をエスケープ(メールアドレスをチェック)
        $email = $mysqli->real_escape_string($email);

        //SQLクエリを作成
        //外部からのリクエストは何が入ってくるかわからないので、必ずエスケープしたものをクォートで囲む
        $query = 'SELECT * FROM users WHERE email = "'.$email.'"';

        //クエリ実行
        $result = $mysqli->query($query);

            //クエリ実行に失敗した場合->return。$resultがfalseだった場合
            if(!$result){
                //MySQL処理中にエラー発生
                echo 'エラーメッセージ:'.$mysqli->error."\n";
                $mysqli->close();
                return false;
            }

        //ユーザー情報を取得。fetch_arrayメソッドはレコードを1件取得する
        $user = $result->fetch_array(MYSQLI_ASSOC);

            //ユーザーが存在しない場合->return
            if(!$user){
                $mysqli->close();
                return false;
            }

            //パスワードチェック、不一致の場合->return
            //$password=入力されたパスワード・$user['password']=DBにあるパスワードのハッシュ値を
            //password_verify関数で一致するかどうかをチェック
            if(!password_verify( $password,$user['password']) ){
                $mysqli->close();
                return false;
            }

        //DB接続を開放
        $mysqli->close();

        //以上に問題なければ findUserAndCheckPasswordにユーザー情報が入る
        return $user;
    }

/**
    * ユーザーを1件取得
    *
    * @param int $user_id
    * @param int $login_user_id
    * @return array|false
    */
    function findUser(int $user_id, int $login_user_id = null)
    {
        // DB接続
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->connect_errno) {
            echo 'MySQLの接続に失敗しました。：' . $mysqli->connect_error . "\n";
            exit;
        }
     
        // エスケープ（SQLインジェクション対策）
        $user_id = $mysqli->real_escape_string($user_id);
        $login_user_id = $mysqli->real_escape_string($login_user_id);
     
        // ------------------------------------
        // SQLクエリを作成(検索)
        // ------------------------------------
        $query = <<<SQL
            SELECT
                U.id,
                U.name,
                U.nickname,
                U.email,
                U.image_name,
                -- フォロー中の数
                (SELECT COUNT(1) FROM follows WHERE status = 'active' AND follow_user_id = U.id) AS follow_user_count,
                -- フォローワーの数
                (SELECT COUNT(1) FROM follows WHERe status = 'active' AND followed_user_id = U.id) AS followed_user_count,
                -- ログインユーザーがフォローしている場合、フォローIDが入る
                F.id AS follow_id
            FROM
                users AS U
                LEFT JOIN
                    follows AS F ON F.status = 'active' AND F.followed_user_id = '$user_id' AND F.follow_user_id = '$login_user_id'
            WHERE
                U.status = 'active' AND U.id = '$user_id'
        SQL;
     
        // ------------------------------------
        // 戻り値を作成
        // ------------------------------------
        // クエリを実行し、SQLエラーでない場合
        if ($result = $mysqli->query($query)) {
            // 戻り値用の変数にセット：ユーザー情報1件
            $response = $result->fetch_array(MYSQLI_ASSOC);
        } else {
            // 戻り値用の変数にセット：失敗
            $response = false;
            echo 'エラーメッセージ：' . $mysqli->error . "\n";
        }
     
        // ------------------------------------
        // 後処理
        // ------------------------------------
        // DB接続を開放
        $mysqli->close();
     
        return $response;
    }    