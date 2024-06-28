$(document).ready(function() {
    var resizeCheck = "small";
    var main_w = $(".has-sidebar").width();
    $('.zoom').click(function() {
        if (resizeCheck == "small") {
            $(".zoom").html("Zoom-");
            $(".has-sidebar").animate({
                "width": "100%"
            });
            $('.sidebar').css("display", "none");
            resizeCheck = "large";
        } else if (resizeCheck == "large") {
            $(".zoom").html("Zoom+");
            $('.has-sidebar').width(main_w);
            $('.sidebar').css("display", "inherit");
            resizeCheck = "small";
        }
    });
    $('.btn-like').click(function() {
        var id = $(this).data('id');
        $('span.vote-count').removeClass('fa-thumbs-o-up');
        $('span.vote-count').addClass('fa-thumbs-up');
        if (id) {
            $.post(qwerty, {
                like_post: 1,
                like: id
            }, function(data) {
                if (data == 0)
                    data = '1';
                $('.vote-count').html(data);
            });
        }
    });
    $('li.video-server').click(function() {
        var postid = $(this).data('postid');
        var server = $(this).data('server');
        $('li.active').removeClass('active');
        $(this).addClass('active');
        $('#video').attr('data-sv', server);
        reloadCurrentserver()
    });
    reloadCurrentserver();
    function activeTab(obj) {
        $('.change-tab ul li').removeClass('l_active');
        $(obj).addClass('l_active');
        var id = $(obj).find('a').attr('href');
        $('.popular-post').hide();
        $(id).show();
    }
    $('.dp-popular-tab li').click(function() {
        activeTab(this);
        return false;
    });
    activeTab($('.dp-popular-tab li:first-child'));
    $(".button-menu").click(function() {
        if (!$('.button-menu').hasClass('active') || !$('.body.row').hasClass('blur')) {
            $(".body.row").addClass("blur");
        } else {
            $(".body.row").removeClass("blur");
        }
        $(this).toggleClass("active");
        $(".list-menu").toggleClass("active");
    });
    $(".button-search").click(function() {
        if (!$('.button-search').hasClass('active') || !$('.body.row').hasClass('blur')) {
            $(".body.row").addClass("blur");
        } else {
            $(".body.row").removeClass("blur");
        }
        $(this).toggleClass("active");
        $(".form-search").toggleClass("active");
    });
    $(".list-menu, .button-menu, .form-search, .button-search, .sub-menu>li").click(function(e) {
        e.stopPropagation();
    });
    $('html, .button-search, .form-search').click(function() {
        if ($('.button-menu').hasClass('active') && !$('.button-search').hasClass('active'))
            $(".body.row").removeClass("blur");
        $('.list-menu').removeClass('active');
        $('.button-menu').removeClass('active');
    });
    $('html, .button-menu, .list-menu').click(function() {
        if ($('.button-search').hasClass('active') && !$('.button-menu').hasClass('active'))
            $(".body.row").removeClass("blur");
        $('.form-search').removeClass('active');
        $('.button-search').removeClass('active');
    });
    $("li.item-menu").click(function() {
        $(this).toggleClass("active");
    });
    $('.item-content-toggle').click(function() {
        if ($(this).find('.show-more').html() == 'Xem thêm')
            $(this).find('.show-more').html('Thu gọn');
        else
            $(this).find('.show-more').html('Xem thêm');
        $('article').toggleClass('toggled');
    });
});
function reloadCurrentserver() {
    var data_id = $('#video').attr('data-id');
    var server_id = $('#video').attr('data-sv');
    if (data_id) {
        server(server_id, data_id);
    }
}
function server(server, id) {
    var id = parseInt(id);
    var server = parseInt(server);
    $.post(qwerty, {
        xxx_server: 1,
        id: id,
        server: server
    }, function(data) {
        $('#video').html(data);
    });
    return false;
}
