/*=============================================================================================
 *
 *=============================================================================================
 */
$('#actualizar').hide();

$('#switch-prj-edit').click(function () {

    if($('#switch-prj-edit').hasClass('inactivo')){
        $('#switch-prj-edit').removeClass('inactivo');
        $('#switch-prj-edit').addClass('activo');
        $('#switch-prj-edit').removeClass('fa-toggle-off');
        $('#switch-prj-edit').addClass('fa-toggle-on');

        $('.edt').prop('disabled',false);
        $("#area").change();
        $('#actualizar').show();


    }else{
        $('#switch-prj-edit').removeClass('fa-toggle-on');
        $('#switch-prj-edit').removeClass('activo');
        $('#switch-prj-edit').addClass('inactivo');
        $('#switch-prj-edit').addClass('fa-toggle-off');

        $('.edt').prop('disabled',true).removeClass("is-invalid");

        $('#actualizar').hide();
        $('.invalid-feedback').html('');
        $('.alert-danger').remove();
    }

});



/*=============================================================================================
 *
 *=============================================================================================
 */


function verificarSelcArea(campo){

    var c=    campo.options[campo.value];
    if (c.text=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}

$( function(){

    $("#fechaI,#fechaF").datepicker({
        dateFormat:'dd-mm-yy',
        maxDate:"+0d",
        minDate:new Date(200,1-1,1),
        changeMonth: true,
        changeYear: true,
        language: 'ES'
    });
} );

function verificarSelcArea(campo){
    var c=($('select[name="area"] option:selected').text());


    if (c.trim()=='Otra area del conocimiento'){
        $('#area-c').prop('disabled',false);
    }else {
        $('#area-c').prop('disabled', true);
    }
}

$(function () {
    var url='/get/OtrasAreasAjax';
    var array=[];
    $.ajax({
        type: "get",
        url: url,
        data: {},
        success: function( data )
        {
            console.log(data);
            $.each(data,function (index,value) {
                array.push(value.rt_nombre_area);
            });

            if (array.length >1){
                $('#area-c').autocomplete({
                    source: array
                });
            }else {
                $('#area-c').val('');
                $('#area-c').prop('disabled',true);
            }

        },
        errors:function () {
            alert("no carga nada :|");
        }
    });
});