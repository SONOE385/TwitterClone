<div class="tweet">
    <div class="user"><!--自分の投稿-->
        <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>"><!--自分のアイコンエリア-->
            <img src="<?php echo buildImagePath( $view_tweet['user_image_name'],'user'); ?>" alt="">
        </a>
    </div>
    <div class="content">
        <div class="name"><!--ユーザー情報が入る-->
            <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>">
                <span class="nickname"><!--ニックネーム、ユーザー名、投稿日時から何日経過したか-->
                    <?php echo htmlspecialchars($view_tweet['user_nickname']); ?><!--太郎-->
                </span>
                <span class="user-name">@<?php echo htmlspecialchars($view_tweet['user_name']);?> ・

                <?php echo convertToDayTimeAgo($view_tweet['tweet_created_at']);?></span>
                            
            </a>
        </div>
            <p><?php echo $view_tweet['tweet_body']; ?></p><!--投稿の内容-->
                        
            <!--ifにすることで、画像を投稿してないのにimgタグが表示されるのを防ぐ。issetで画像がある場合は表示させるという式-->
            <?php if (isset($view_tweet['tweet_image_name'])):?>
                <img src="<?php echo buildImagePath($view_tweet['tweet_image_name'],'tweet'); ?>" alt="" class="post-image"><!--投稿画像のimgを設置-->
            <?php endif ?>
                        
            <div class="icon-list"><!--いいねの♥といいねの数が入る-->
                <div class="like js-like" data-tweet-id="<?php echo htmlspecialchars($view_tweet['like_id']); ?>">
                    <?php 
                        if (isset($view_tweet['like_id'])){
                            echo '<img src="' .HOME_URL. 'Views/img/icon-heart-twitterblue.svg" alt="">';
                        }else{
                            echo '<img src="' .HOME_URL. 'Views/img/icon-heart.svg" alt="">';
                        }
                    ?>        
                </div>
                <div class="like-count js-like-count"><?php echo htmlspecialchars($view_tweet['like_count']); ?></div><!--いいね数-->
            </div>
    </div>
</div>
