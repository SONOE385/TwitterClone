///////////////////////////////////
//いいね！用のjavascript
///////////////////////////////////

$(function () {
    // いいね！がクリックされたとき
    $('.js-like').click(function () {// js-likeクラスがクリックされたときにfunction内の処理を実行
        const this_obj = $(this);// this_objにはクリックされた要素が入る。constで再代入できなくする。$(this)=$('.js-like')のこと。
        const tweet_id = $(this).data('tweet-id');
        const like_id = $(this).data('like-id');// クリックされた要素のdata属性のlike_idがconst like_idに入る
        const like_count_obj = $(this).parent().find('.js-like-count');// クリック要素(this)の中にある、js-like-countクラスの
        // 要素が const like_count_objに入る
        let like_count = Number(like_count_obj.html());// js-like要素から、いいね数を取得


        if(like_id){
            // いいね!取り消し
            // 非同期通信
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: {
                    'like_id':like_id
                },
                timeout:10000
            })
            // ajaxにて取り消しが成功すればdone実行
            .done(() => {
                
                like_count--;
                like_count_obj.html(like_count);
                this_obj.data('like-id',null);
                            
                $(this).find('img').attr('src','../Views/img/icon-heart.svg');
            })
            // failでエラーの場合の処理をしておく。
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            });
            // この時点で、.で全て連携して処理が行われるだけで、responseがあるまで処理は実行されず保留してある
        }else{
            // いいね!付与
            // 非同期通信
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: {
                    'tweet_id': tweet_id
                },
                timeout:10000
            })
            // いいね!が成功
            .done((data) => {
                like_count++;
                like_count_obj.html(like_count);
                this_obj.data('like-id', data["like_id"]);
                    
                $(this).find('img').attr('src','../Views/img/icon-heart-twitterblue.svg');
            })
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            });
        }
    });
})