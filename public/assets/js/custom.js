function createAutoClosingAlert(selector, delay) {
    var alert = $(selector).addClass('into').alert();
    window.setTimeout(function () {
        alert.alert('close')
    }, delay);
}
$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
$(document).ready(function () {
    // $(":file").filestyle('buttonText', 'Chọn ảnh');
    createAutoClosingAlert("#success-alert", 3000);
    
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        // other options
        onConfirm: function () {
            if ($(this).attr('id') == "bulk-delete") {
                var is_check = $('input:checkbox[name="val[]"]:checked').length;
                if (is_check <= 0) {
                    alert("Vui lòng chọn dòng cần xóa.");
                    return;
                }
                $('#hidAction').val('delete');
                $('#frmMain').submit();
            }
            if ($(this).attr('id') == "bulk-sort") {
                $('input:checkbox[name="val[]"]').attr('checked', 'checked');
                $('#hidAction').val('sorting');
                $('#frmMain').submit();
            }
            return true;
        },
        onCancel: function () {
            return false;
        }
    });
    
});

