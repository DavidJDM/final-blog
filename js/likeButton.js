$("i.fas.fa-heart").click(function(){
    let id = $(this).next('span').attr('id');
    id = id.match(/\d+/);
    id = parseInt(id, 10);
    $.post(
        'checkLikedStatus',
        {post_id : id},
        function(result) {
            if(result) {
                if($(this).hasClass("notliked"))
                {
                    var heartNum = $(this).parent().text();
                    heartNum = parseInt(heartNum) + 1;

                    $(this).next("span").text(heartNum);

                    $(this).removeClass("notliked");
                    $(this).addClass("liked");
                }

                else if($(this).hasClass("liked"))
                {
                    var heartNum = $(this).parent().text();
                    heartNum = parseInt(heartNum) - 1;

                    $(this).next("span").text(heartNum);

                    $(this).removeClass("liked");
                    $(this).addClass("notliked");
                }
            }
            else {
                let answer = confirm("You are not logged in. Would you like to log in?");

                if(answer) {
                    window.location.replace('sign-in');
                }
            }
        }
    );
});