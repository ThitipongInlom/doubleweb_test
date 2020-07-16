$(document).ready(function () {
    $("#login_password").keyup(function (event) {
        if (event.keyCode === 13) {
            if ($("#btn_login").attr('disabled') == 'disabled') {
                console.log('มีอักษรพิเศษ')
            }else {
                $("#btn_login").click();
            }
        }
    });
});

var Save_login = function Save_login() {
    console.log('User Login')
    var Array_id = [
        'from_id',
        'login_username',
        'login_password'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
        var Data = new FormData();
        $(Array_id).each(function (index, value) {
            Data.append($("#" + value).attr('name'), $("#" + value).val());
        });
        $.ajax({
            type: 'POST',
            url: 'server/login.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: Data,
            success: function (result) {
                if (result.status == 200) {
                    location.replace("crud.php");
                }else {

                }
                console.log(result);
            }
        });
    } else {
        console.log('ข้อมูลยังไม่ครบ')
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