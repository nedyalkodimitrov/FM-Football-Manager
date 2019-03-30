$('.btn-submit').on('click', function() {
    var email = $("#email").val() ;
    var pass = $("#password").val();
    var name = $("#name").val() ;
    var fName = $("#fName").val();
    var role = $("#position").val();

    $.ajax({
        type: "POST",
        url: "/signUp",
        data: {'appbundle_users[email]': email, 'appbundle_users[password]': pass, 'appbundle_users[name]': name, 'appbundle_users[fName]': fName, 'role': role}
    })
        .done(function( msg ) {
            console.log(  msg );
        });


});

