

$("#area").change();
$( function(){

    $("#fecha").datepicker({
        dateFormat:'dd-mm-yy',
        maxDate:"-15y",
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

$(function(){

    $(function() {
        $('#foto').change(function(e) {
            addImage(e);
        });

        function addImage(e){
            var file = e.target.files[0],
                imageType = /image.*/;

            if (!file.type.match(imageType)){
                $('#imgSalida').attr("src"," ");
                return;
            }


            var reader = new FileReader();
            reader.onload = fileOnload;
            reader.readAsDataURL(file);
        }

        function fileOnload(e) {
            var result=e.target.result;
            $('#imgSalida').attr("src",result);
        }
    });
});

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
