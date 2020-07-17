
$(document).ready(function () {
    $(".btn-refresh").click(function () {
        tableGeneral.ajax.reload();
    });

    var column_list = [
        {
            "data": "image",
            render: function (data, type, row) {
                var image = '<img src="/uploads/products/' + data + '" class="img-thumbnail">';
                return image;
            },
            "className": "text-center",
        },
        {
            "data": "category",
            render: $.fn.dataTable.render.text()
        },
        {
            "data": "name",
            render: $.fn.dataTable.render.text()
        },
        {
            "data": "description",
            render: $.fn.dataTable.render.text()
        },
        {
            "data": "id",
            render: function (data, type, row) {
                var btn = '<div class="btn-group" role="group" aria-label="Basic example">' +
                    '<a class="btn btn-info btn-sm"' +
                    ' data-toggle="modal"' +
                    ' data-title="Edit Data"' +
                    ' data-post-id="' + data + '"' +
                    ' data-action-url="product/formEdit"' +
                    ' data-target="#form-modal"' +
                    ' href="javascript:void(0);">' +
                    'Edit' +
                    '</a>' +
                    '<a class="btn btn-danger btn-sm"' +
                    ' onclick="deleted(\'' + data + '\');"' +
                    ' href="javascript:void(0);">' +
                    'Delete' +
                    '</a>' +
                    '</div>';
                return btn;
            },
            "className": "text-center",
        }
    ];

    var column_def = [
        {
            "orderable": false,
            "targets": 0
        },
        {
            "orderable": true,
            "targets": 1
        },
        {
            "orderable": false,
            "targets": 4
        }
    ];

    tableGeneral = $('.tableGeneral').DataTable({
        "bProcessing": true,
        "bServerSide": true,
        "searchDelay": 150,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columnDefs": column_def,
        "columns": column_list,
        "order": [[1, "asc"]],
        "fnServerParams": function (aoData) {
            aoData.push({
                "name": 'csrf-token'
                , "value": $('meta[name=csrf-token]').attr("content")
            });
        },
        "fnServerData": function (sSource, aoData, fnCallback) {
            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": sSource,
                "data": aoData,
                "beforeSend": function () {
                    $(".btn").addClass('disabled');
                },
                "success": function (resp) {
                    $(".btn").removeClass('disabled');
                    fnCallback(resp);
                },
                "error": function (event, textStatus, errorThrown) {
                    $(".btn").removeClass('disabled');
                }
            });
        },
        "sAjaxSource": base_url('product/jsonDataTable'),
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: ''
                }
            },

            buttons: [
                {
                    extend: 'copy',
                    exportOptions: { orthogonal: 'export' },
                    className: 'btn btn-sm btn-secondary'
                },
                {
                    extend: 'excel',
                    exportOptions: { orthogonal: 'export' },
                    className: 'btn btn-sm btn-success'
                },
                {
                    extend: 'pdf',
                    orientation: 'potrait',
                    exportOptions: { orthogonal: 'export-pdf' },
                    className: 'btn btn-sm btn-danger'
                }
            ]
        },
        "sDom": "<'row'<'col-sm-6' l ><'col-sm-6 text-right' B> r> t <'row'<'col-sm-6' i><'col-sm-6 text-right' p>> ",
        "oLanguage": {
            "sLengthMenu": "_MENU_",
            "sZeroRecords": "Sorry, No data avaliable in table",
            "sProcessing": "<i class=\"fa fa-refresh fa-spin\"></i> <span style=\"padding-left: 15px;\">Loading Data</span>",
            "sInfo": "_START_ - _END_ / _TOTAL_",
            "sInfoFiltered": "",
            "sInfoEmpty": "0 - 0 / 0",
            "infoFiltered": "(_MAX_)",
            "oPaginate": {
                "sPrevious": "<i class='fa fa-angle-double-left'></i>",
                "sNext": "<i class='fa fa-angle-double-right'></i>"
            }
        }
    });

    $('.tableGeneral tfoot th').each(function () {
        var title = $('.tableGeneral tfoot th').eq($(this).index()).text();
        if (title !== "ID") {
            $(this).html('<input type="text" class="form-control form-control-sm form-datatable" style="width:100%;border-radius: 0px;" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    tableGeneral.columns().every(function () {
        var that = this;
        $('input', this.footer()).on('keyup change', function (ev) {
            //if (ev.keyCode == 13) { //only on enter keypress (code 13)
            that
                .search(this.value)
                .draw();
            //}
        });
    });
});

function deleted(id) {
    Swal.fire({
        title: "Delete Confirmation",
        text: "Deleted data cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#c9302c",
        confirmButtonText: "Yes, Please",
        cancelButtonText: "No, Cancel It"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: base_url('product/delete'),
                data: {
                    "id": id
                    , "stat": "delete"
                    , "csrf-token": $('meta[name=csrf-token]').attr("content")
                },
                success: function (resp) {
                    tableGeneral.ajax.reload();
                    if (isJson(resp)) {
                        var obj = jQuery.parseJSON(resp);
                        if (obj.state === '200') {
                            toast(obj.message, obj.title, 'success');
                        } else {
                            toast(obj.message, obj.title, 'error');
                        }
                    }
                },
                error: function (event, textStatus, errorThrown) {
                    console.log('Pesan: ' + textStatus + ' , HTTP: ' + errorThrown);
                }
            });
        }
    });
}