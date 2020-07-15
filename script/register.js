var Show_register = function Show_register() {
    console.log('Register Show')
    $('#register').modal({
        backdrop: 'static',
        show: true
    })
}

var Save_register = function Save_register() {
    console.log('Save Regiser')
    var Data = new FormData();
    Data.append('username', $("#register_username").val())
    Data.append($("#from_id").attr('name'), $("#from_id").val())
    $.ajax({
        type: 'POST',
        url: 'server/test.php',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (result) {
            console.log(result);
        }
    });
}