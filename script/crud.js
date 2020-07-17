$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    $('#example').DataTable({
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
                var btn_r = '<button class="btn btn-sm btn-outline-info" member_id="' + data + '" ><i class="fas fa-search"></i></button>';
                var btn_u = '<button class="btn btn-sm btn-outline-warning" member_id="' + data + '" ><i class="fas fa-edit"></i></button>';
                var btn_d = '<button class="btn btn-sm btn-outline-danger" member_id="' + data + '" ><i class="fas fa-trash"></i></button>';
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