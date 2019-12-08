
$('.treatment').on('click', function () {
    $('.player-status-container').css('visibility', 'visible')
        .css('height', '100vh')

    $('.player-status-div')
        .css('top', '50%')
        .css('transform', ' translate(-50%, -50%)');

    $('#treatment_info').css('visibility', 'visible');

    $('.fa-times-circle').on('click', function () {
        $('.player-status-div')
            .css('top', '0%')
            .css('transform', ' translate(-50%, -100%)');

        $('.player-status-container').css('visibility', '')
            .css('height', '0vh')


    });


});

$('.delete-injured').on('click', function () {
    var statId =  $(this).attr('id');
    console.log(statId);
    $.ajax({
        method: "POST",
        url: "/player/deleteStat/"+statId,
    })
        .done(function( msg ) {
            if (msg == 1){
                iziToast.success({
                    title: '',
                    message: 'Вие успешно уведомихте треньора, че няма да ходите на тренировка',
                    position: 'topRight',
                });
                $('.' + statId).remove();
            }


        });
});


$(".startDate-input").inputmask("dd/mm/yyyy", {
    placeholder: "dd/mm/YYYY",
    alias: "date",
    clearIncomplete: true
});
$(".endDate-input").inputmask("dd/mm/yyyy", {
    placeholder: "dd/mm/YYYY",
    alias: "date",
    clearIncomplete: true
});


$('.select').on('change', function () {
    if ($('.select').val == 'family'){
        console.log('1');

    }
});

$('#send-info').on('click', function () {
    var status = $('#status').val();
    var medicaments = $('.medicaments').val();
    var startTreatment = $('.startDate-input').val();
    var endTreatment = $('.endDate-input').val();



    var timeCheck = false;
    var statusCheck = false;
    var day = new Date();
    var dd = day.getDate();
    var mm = day.getMonth() + 1; //January is 0!
    var secondmm = day.getMonth() + 2;
    var yyyy = day.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }


    var start = startTreatment.split('/');
    var end = endTreatment.split('/');

    if(dd <= start[0] && mm<=start[1] && yyyy == start[2] && secondmm > start[1]  && start[0] <= end[0] && start[1] <= end[1] && end[1] <= secondmm && end[2]==yyyy){
        var timeCheck = true;
    }else {
        iziToast.warning({
            title: 'Грешни данни',
            message: "Неможе началната дата да е по-голяма от крайната",
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 2000,
        });
    }
    if(status != 0){
        statusCheck = true;
    }else {
        iziToast.warning({
            title: 'Грешни данни',
            message: "Моля изберете причината, поради която ще отсъствате",
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 2000,
        });
    }

    if (statusCheck == true && timeCheck == true){
        $.ajax({
            method: "POST",
            data: {"appbundle_playersinjured[status]": status, "appbundle_playersinjured[medicaments]": medicaments, "appbundle_playersinjured[startTreatment]": startTreatment, "appbundle_playersinjured[endTreatment]": endTreatment},
            url: "{{ path('playerTraining') }}",
        })
            .done(function( msg ) {
                console.log(msg);
                if(msg == 1){
                    iziToast.success({
                        title: '',
                        message: 'Вие успешно уведомихте треньора, че няма да ходите на тренировка',
                        position: 'topRight',
                    });
                }else if(msg == 2){
                    iziToast.warning({
                        title: 'Грешка',
                        message: "Имате съвпадение в датите",
                        overlay: true,
                        zindex: 999,
                        position: 'center',
                        timeout: 20000,
                    });
                }else{
                    iziToast.warning({
                        title: 'Грешка',
                        message: "Грешла при записването на данни",
                        overlay: true,
                        zindex: 999,
                        position: 'center',
                        timeout: 20000,
                    });
                }
                $('#status').val('');
                $('.medicaments').val('');
                $('.startDate-input').val('');
                $('.endDate-input').val('');
            });
    }
});