$(document).ready(function () {
    $(".btn-submit").click(function () {
        submit();
    });
});

function submit() {
    var input = $(this).serialize();
    var submit = $(this).attr('action');
    $("#form-submit").ajaxForm({
        type: "POST",
        url: submit,
        data: input,
        beforeSend: function (result) {
            $(".btn").attr('disabled', true);
        },
        success: function (resp) {
            $(".btn").attr('disabled', false);
            if (isJson(resp)) {
                console.log(resp);
                var obj = jQuery.parseJSON(resp);
                if (obj.state === "200") {
                    $('#form-modal').modal("hide");
                    toast(obj.message, obj.title, 'success');
                    tableGeneral.ajax.reload();
                } else {
                    toast(obj.message, obj.title, 'error');
                }
            } else {
                toast('Kesalahan : server tidak memberikan respon yang sesuai', 'Kesalahan', 'error');
            }
        },
        error: function (event, textStatus, errorThrown) {
            $(".btn").attr('disabled', false);
            toast(textStatus, errorThrown, 'error');
        }
    });
}
