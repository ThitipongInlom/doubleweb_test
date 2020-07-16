var Show_register = function Show_register() {
    console.log('Register Show')
    $('#register').modal({
        backdrop: 'static',
        show: true
    })

    $('#register').on('hidden.bs.modal', function (e) {
        console.log('Register Hide')
        $("#register_username").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#register_password").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#register_fristname").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#register_lastname").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#register_phone").removeClass('is-valid').removeClass('is-invalid').val('');
    })
}

var Save_register = function Save_register() {
    console.log('Save Regiser')
    var Array_id = [
        'from_id',
        'register_username',
        'register_password',
        'register_fristname',
        'register_lastname',
        'register_phone'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
        var Data = new FormData();
        $(Array_id).each(function (index, value) {
            Data.append($("#" + value).attr('name'), $("#" + value).val());
        });
        $.ajax({
            type: 'POST',
            url: 'server/register.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: Data,
            success: function (result) {
                $("#register").modal('hide');
            }
        });
    }else {
        console.log('ข้อมูลยังไม่ครบ')
    }
}

var Check_password_special = function Check_password_special(e) {
    // เช็คห้ามใช้อักษร พิเศษ
    if (!e.value.match(/^[ก-ฮa-z0-9]+$/i) && e.value.length > 0) {
        $(e).addClass('is-invalid');
        $("#btn_login").addClass('disabled').attr('disabled', 'disabled');
        $("#btn_register").addClass('disabled').attr('disabled', 'disabled');
    }else {
        $(e).removeClass('is-invalid');
        $("#btn_login").removeClass('disabled').removeAttr('disabled');
        $("#btn_register").removeClass('disabled').removeAttr('disabled');
    }
}

var Check_null_input = function Check_null_input(Array_id) {
    var success_rows = 0;
    var error_rows = 0;

    $(Array_id).each(function (index, value) {
        function Check_null_Input() {
            if ($("#" + value).val() == '') {
                $("#" + value).removeClass('is-valid');
                $("#" + value).addClass('is-invalid');
                return false;
            } else {
                $("#" + value).removeClass('is-invalid');
                $("#" + value).addClass('is-valid');
                return true;
            }
        }
        var Check_null_Input = Check_null_Input() == true ? success_rows++ : error_rows++;
    });
    var result = success_rows == Array_id.length ? true : false;
    return result;
}