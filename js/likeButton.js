$("i.fas.fa-heart").click(function(){
    let postID = $(this).next('span').attr('id');
    postID = postID.match(/\d+/);
    postID = parseInt(postID, 10);
    let form = $(this);
    // let loggedIn = false;
    $.post(
        'checkLikedStatus',
        {post_id : postID},
        function(result) {
            if(parseInt(result) === 1) {
                $.ajax({
                    success : function() {

                        if(form.hasClass('notliked'))
                        {
                            let heartNum = form.parent().text();
                            heartNum = parseInt(heartNum) + 1;

                            form.next("span").text(heartNum);

                            form.css("color", "#e30000");
                            form.css("-webkit-text-stroke", "1px #e30000");

                            form.removeClass("notliked");
                            form.addClass("liked");
                        }

                        else if(form.hasClass('liked'))
                        {
                            let heartNum = form.parent().text();
                            heartNum = parseInt(heartNum) - 1;

                            form.next("span").text(heartNum);

                            form.css("color", "white");
                            form.css("-webkit-text-stroke", "1px #b5aec4");

                            form.removeClass("liked");
                            form.addClass("notliked");
                        }

                    }
                });
            }
            else {
                let answer = confirm("You are not logged in. Would you like to log in?");

                if(answer) {
                    window.location.replace('sign-in');
                }
            }
        }
    );
    // alert(loggedIn);
    // if(loggedIn === true) {

    // }
});