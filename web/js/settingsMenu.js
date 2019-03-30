$('.settings-icon').on('click', function() {


    if($('.settings-navbar').hasClass('hiden')){
        $('.settings-navbar').css('display', 'inline-block');
        $('.settings-navbar').removeClass('hiden');
        $('.settings-navbar').addClass('showed');
    }else  {
        $('.settings-navbar').css('display', 'none');
        $('.settings-navbar').removeClass('showed');
        $('.settings-navbar').addClass('hiden')
    }

});

