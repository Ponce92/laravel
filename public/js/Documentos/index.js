$('#frm_upload').dialog(
    {
        autoOpen:false,
        width:500,
        modal:true,
    }
);

$("#uploadDoc").click(function () {
    $('#frm_upload').dialog('open');
});

function closeFM(){
    $('#frm_upload').dialog('close');
}

$('li.active >span').addClass('page-link');
$('li.disabled >span').addClass('page-link');

function OpenModal(){
    $('#frm_upload').dialog('open');
}