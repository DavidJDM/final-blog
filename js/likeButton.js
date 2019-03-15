$("i.fas.fa-heart").click(function(){
    let id = $(this).next('span').attr('id');
    id = id.match(/\d+/);
    // id = parseInt(id);
    alert(id);
    alert('before post');
    $.post(
        'jquery/likeButton.php',
        {id : id},
        function(result) {
            if(!result) {
                alert("you are not signed in");
            }
            else {
                alert("you are signed in");
            }
        }
    );
    alert('after post');
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