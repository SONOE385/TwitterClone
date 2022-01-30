/////////////////////////////////////
//いいね！用のjavascript
/////////////////////////////////////

$(function(){
    //いいね！がクリックされたとき
    $('.js-like').click(function(){//js-likeクラスがクリックされたときにfunction内の処理を実行
        const this_obj = $(this);//this_objにはクリックされた要素が入る。constで再代入できなくする。$(this)=$('.js-like')のこと。
        const like_id = $(this).data('like-id');//クリックされた要素のdata属性のlike_idがconst like_idに入る
        const like_count_obj = $(this).parent().find('.js-like-count');//クリック要素(this)の中にある、js-like-countクラスの
        //要素が const like_count_objに入る
        let like_count = Number(like_count_obj.html());//js-like要素から、いいね数を取得
        console.log(like_count);


        if(like_id){//like_idの中身があるとき
            like_count--;//いいね！取り消し・カウントを減らす
            like_count_obj.html(like_count);//いいね数の要素に、更新したいいね数をhtmlにセット
            this_obj.data('like-id',null);//クリック要素(this_obj)のデータ属性のlike-idを削除
                        
            $(this).find('img').attr('src','../Views/img/icon-heart.svg');//いいね！ボタンの色をグレーに変更
        }else{
            like_count++;//いいね！付与・カウントを増やす
            like_count_obj.html(like_count);//いいね数の要素に、更新したいいね数をhtmlにセット
            this_obj.data('like-id',true);//クリック要素(this_obj)のデータ属性のlike-idを更新
                
            $(this).find('img').attr('src','../Views/img/icon-heart-twitterblue.svg');//いいね！ボタンの色を青に変更
            }
    });
})