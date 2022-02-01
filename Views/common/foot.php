<script>//第一引数にDOMContentLoadedを入れると、htmlの読み込みが終了した段階で第2引数の処理を始める
    document.addEventListener('DOMContentLoaded',function(){
        $('.js-popover').popover();
        },false);
</script>