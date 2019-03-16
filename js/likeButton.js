$("i.fas.fa-heart").click(function(){
    let id = $(this).next('span').attr('id');
    id = id.match(/\d+/);
    id = parseInt(id, 10);
    $.post(
        'jquery/likeButton.php',
        {post_id : id},
        function(result, status) {
            if(status) {
                alert('status == true');
                alert(result);
            }
            else {
                alert('else');
                alert(result);
            }
        }
    );
    if($(this).hasClass("notliked"))
    {
        var heartNum = $(this).parent().text();
        heartNum = parseInt(heartNum) + 1;

        $(this).next("span").text(heartNum);

        $(this).css("color", "#e30000");
        $(this).css("-webkit-text-stroke", "1px #e30000");

        $(this).removeClass("notliked");
        $(this).addClass("liked");
    }

    else if($(this).hasClass("liked"))
    {
        var heartNum = $(this).parent().text();
        heartNum = parseInt(heartNum) - 1;

        $(this).next("span").text(heartNum);

        $(this).css("color", "white");
        $(this).css("-webkit-text-stroke", "1px #b5aec4");

        $(this).removeClass("liked");
        $(this).addClass("notliked");
    }
});