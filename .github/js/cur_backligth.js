$(function() {

    var pathname_url = window.location.pathname;
    var href_url = window.location.href;
    //alert(pathname_url);

    $(".menu a").each(function () {

        var link = $(this).attr("href");
        //alert(link);
        if(pathname_url == link || href_url.search(link) != -1 || (href_url.search("personal_block") != -1 && link.search("personal_block") != -1) ) {
            // (href_url.search("personal_block") != -1 && link.search("personal_block") != -1) костыль надо исправить
            $(this).addClass('active');
        }
    });
});