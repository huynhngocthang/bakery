var roxyFileman = BASE_URL + 'fileman/index.html'
$(function () {
    CKEDITOR.replace('description',{
            filebrowserBrowseUrl:roxyFileman,
            filebrowserImageBrowseUrl:roxyFileman+'?type=image',
            removeDialogTabs: 'link:upload;image:upload'
            //filebrowserImageBrowseUrl : BASE_URL + 'assets/filemanager/index.html?type=image'
    });
    $('#other-imgs').on('click','.remove-other-img', function(){
    	$(this).closest('.other-img').remove();
    });
    if(typeof(selected_categories) != 'undefined' && selected_categories.length > 0) {
        $('#category_id').val(selected_categories).trigger('change');
    }

    $('.openCustomRoxy').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('#fileManagerModal .modal-body').load(dataURL,function(){
            $('#fileManagerModal').modal({show:true});
        });
    }); 
});
function openCustomRoxy($id, $url){
    $('#'+$id).find('iframe').attr('src', $url);
  $('#' + $id).dialog({modal:true, width:875,height:600});
}
function closeCustomRoxy($id){
  $('#' + $id).dialog('close');
}

function addOtherImage($img) {
	var imgWrap = '<div id="" class="other-img col-sm-4 col-md-2">' +
    '<input type="hidden" name="other_img[]" value="'+ $img +'" />' +
    '<img id="otherPreview1" class="img-thumbnail" alt="Chưa có ảnh sản phẩm" src="'+ $img +'" style="width: 100%;" />' +
    '<button title="Xóa" class="btn btn-xs btn-danger remove-other-img"><i class="fa fa-times"></i></button>'+
    '</div>';
    $('#other-imgs').append(imgWrap);
}