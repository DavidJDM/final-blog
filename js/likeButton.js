$("i.fas.fa-heart").click(function(){
    let id = $(this).next('span').attr('id');
    id = id.match(/\d+/);
    id = parseInt(id, 10);
    $.post(
        'checkLikedStatus',
        {post_id : id},
        function(result) {
            if(result) {
                alert('result == true');
                alert(result);
            }
            else {
                let answer = confirm("You are not logged in. Would you like to log in?");

                if(answer) {
                    window.location.replace('sign-in');
                }
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