$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    $('#member_table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "aLengthMenu": [
            [10, 20, -1],
            ["10", "20", "ทั้งหมด"]
        ],
        "ajax": {
            "url": 'server/datatables/server_processing.php',
            "type": 'get'
        },
        "columns": [{
            "data": '0',
        }, {
            "data": '1',
        }, {
            "data": '2',
        }, {
            "data": '3',
        }, {
            "data": '4',
            "render": function (data, type, full, meta) {
                var btn_r = '<button class="btn btn-sm btn-outline-info" member_id="' + data + '" onclick="view_data_modal(this)"><i class="fas fa-search"></i></button>';
                var btn_u = '<button class="btn btn-sm btn-outline-warning" member_id="' + data + '" onclick="Edit_data_modal(this)"><i class="fas fa-edit"></i></button>';
                var btn_d = '<button class="btn btn-sm btn-outline-danger" member_id="' + data + '" onclick="Delete_data_modal(this)"><i class="fas fa-trash"></i></button>';
                return btn_r + ' '+ btn_u +' ' + btn_d;
            }
        }],
        "language": {
            "lengthMenu": "แสดง _MENU_ รายการ",
            "search": "ค้นหา:",
            "info": "แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ รายการ",
            "infoEmpty": "แสดง 0 ถึง 0 ทั้งหมด 0 รายการ",
            "infoFiltered": "(จาก ทั้งหมด _MAX_ ทั้งหมด รายการ)",
            "processing": "กำลังโหลดข้อมูล...",
            "zeroRecords": "ไม่มีข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ต่อไป",
                "previous": "ย้อนกลับ"
            },
        }
    });
});

var Create_data_modal = function Create_data_modal() {
    $("#create_data_modal").modal({
        keyboard: false,
        backdrop: 'static',
        show: true
    });

    $('#create_data_modal').on('hidden.bs.modal', function (e) {
        console.log('Create Hide')
        $("#create_username").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_password").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_fristname").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_lastname").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#create_phone").removeClass('is-valid').removeClass('is-invalid').val('');
    })
}

var view_data_modal = function view_data_modal(e) {
    $("#view_data_modal").modal('show');
    var Data = new FormData();
    Data.append($("#player_id").attr('name'), $(e).attr('member_id'));
    $.ajax({
        type: 'POST',
        url: 'server/crud.php?action=Get_user',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (result) {
            $('#view_data_modal .create_user').text(moment(result.data.create_time).format('DD/MM/YYYY H:mm:ss'))
            $('#view_data_modal .username').text('Username : ' + result.data.player_username)
            $('#view_data_modal .name').text('Name : ' + result.data.player_fristname + " " + result.data.player_lastname)
            $('#view_data_modal .phone').text('Phone : ' + result.data.player_phone_number)
            $('#view_data_modal .note').text('Note : ' + result.data.player_note)
        }
    });
}

var Edit_data_modal = function Edit_data_modal(e) {
    $("#edit_data_modal").modal({
        keyboard: false,
        backdrop: 'static',
        show: true
    });
    $("#btn_edit").attr('member_id', $(e).attr('member_id'));
    var Data = new FormData();
    Data.append($("#player_id").attr('name'), $(e).attr('member_id'));
    $.ajax({
        type: 'POST',
        url: 'server/crud.php?action=Get_edit_user',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        success: function (result) {
            $('#edit_username').val(result.data.player_username)
            $('#edit_password').val(result.data.player_plain_password)
            $('#edit_fristname').val(result.data.player_fristname)
            $('#edit_lastname').val(result.data.player_lastname)
            $('#edit_phone').val(result.data.player_phone_number)
            $('#edit_note').val(result.data.player_note)
        }
    });

    $('#edit_data_modal').on('hidden.bs.modal', function (e) {
        $("#edit_username").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_password").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_fristname").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_lastname").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_phone").removeClass('is-valid').removeClass('is-invalid').val('');
        $("#edit_note").removeClass('is-valid').removeClass('is-invalid').val('');
    })
}

var Delete_data_modal = function Delete_data_modal(e) {
    $("#delete_data_modal").modal('show');
    $("#btn_delete").attr('member_id', $(e).attr('member_id'));
}

var Save_Create = function Save_Create() {
    var Toast = Set_Toast();
    var Array_id = [
        'from_id',
        'create_username',
        'create_password',
        'create_fristname',
        'create_lastname',
        'create_phone'
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
                $("#create_data_modal").modal('hide');
                $('#member_table').DataTable().draw();
                Toast.fire({
                    icon: 'success',
                    title: result.mag
                })
            }
        });
    } else {
        Toast.fire({
            icon: 'error',
            title: 'ข้อมูลยังไม่ครบ'
        })
    }
}

var Save_Edit = function Save_Edit(e) {
    var Toast = Set_Toast();
    var Array_id = [
        'from_id',
        'edit_password',
        'edit_fristname',
        'edit_lastname',
        'edit_phone',
        'edit_note'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
        var Data = new FormData();
        $(Array_id).each(function (index, value) {
            Data.append($("#" + value).attr('name'), $("#" + value).val());
        });
        Data.append($("#player_id").attr('name'), $(e).attr('member_id'));
        $.ajax({
            type: 'POST',
            url: 'server/crud.php?action=Save_edit_user',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: Data,
            success: function (result) {
                $("#edit_data_modal").modal('hide');
                $('#member_table').DataTable().draw();
                Toast.fire({
                    icon: 'success',
                    title: result.mag
                })
            }
        });
    } else {
        Toast.fire({
            icon: 'error',
            title: 'ข้อมูลยังไม่ครบ'
        })
    }
}

var Save_Delete = function Save_Delete(e) {
    var Toast = Set_Toast();
    var Data = new FormData();
    Data.append($("#player_id").attr('name'), $(e).attr('member_id'));
        $.ajax({
            type: 'POST',
            url: 'server/crud.php?action=Save_delete_user',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: Data,
            success: function (result) {
                $("#delete_data_modal").modal('hide');
                $('#member_table').DataTable().draw();
                Toast.fire({
                    icon: 'success',
                    title: result.mag
                })
            }
        });
}

var Check_password_special = function Check_password_special(e) {
    // เช็คห้ามใช้อักษร พิเศษ
    if (!e.value.match(/^[ก-ฮa-z0-9]+$/i) && e.value.length > 0) {
        $(e).addClass('is-invalid');
        $("#btn_create").addClass('disabled').attr('disabled', 'disabled');
    } else {
        $(e).removeClass('is-invalid');
        $("#btn_create").removeClass('disabled').removeAttr('disabled');
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

var Set_Toast = function Set_Toast() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    return Toast
}
