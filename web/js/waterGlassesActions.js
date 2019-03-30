$('.water-button-minus').on('click', function() {

    var numOfWaterGlasses = parseInt($('.numOfWaterGlasses').text());
    if (numOfWaterGlasses >= 0 && numOfWaterGlasses < 20){
        var currentWaterGlasses = numOfWaterGlasses - 1;
    }
    $.ajax({
        url: '/player/removeWaterGlasses',

    })
        .done(function( msg ) {

        });
    $('.numOfWaterGlasses').html(currentWaterGlasses);
});


$('.water-button-plus').on('click', function() {

    var numOfWaterGlasses = parseInt($('.numOfWaterGlasses').text());
    if (numOfWaterGlasses >= 0 && numOfWaterGlasses < 20){
        var currentWaterGlasses = numOfWaterGlasses + 1;
    }
    $.ajax({
        url: '/player/addWaterGlasses',

    })
        .done(function( msg ) {

        });

    $('.numOfWaterGlasses').html(currentWaterGlasses);

});


