

$( function() {
    $( "#datepicker" ).datepicker();
} );

$('#switch-persona').click(function () {
    if ($('#switch-persona').hasClass('inactivo')){
        $('#switch-persona').removeClass('inactivo');
        $('#switch-persona').addClass('activo');
        $('#switch-persona').removeClass('fa-toggle-off');
        $('#switch-persona').addClass('fa-toggle-on');

        /* ................  Se habilitan los campos correspondientes para su edicion................*/
        $('#fotoPersona').removeAttr("disabled");
        $('#nombrePersona').removeAttr("disabled");
        $('#apellidosPersona').removeAttr("disabled");
        $('#datepicker').removeAttr("disabled");
        $('#telefonoPersona').removeAttr("disabled");
        $('#nacionalidadPersona').removeAttr("disabled");
        $('#grado').removeAttr("disabled");
        $('#area').removeAttr("disabled");
        $('#horas').removeAttr("disabled");
        $('#institucion').removeAttr("disabled");
        $('#direccion').removeAttr("disabled");

    }else{

        $('#switch-persona').removeClass('fa-toggle-on');
        $('#switch-persona').removeClass('activo');
        $('#switch-persona').addClass('inactivo');
        $('#switch-persona').addClass('fa-toggle-off');

        /* ................  Se deshabilitan los campos correspondientes para su edicion................*/
        $('#fotoPersona').attr("disabled",true);
        $('#nombrePersona').attr("disabled",true);
        $('#apellidosPersona').attr("disabled",true);
        $('#datepicker').attr("disabled",true);
        $('#telefonoPersona').attr("disabled",true);
        $('#nacionalidadPersona').attr("disabled",true);
        $('#grado').attr("disabled",true);
        $('#area').attr("disabled",true);
        $('#horas').attr("disabled",true);
        $('#institucion').prop("disabled",true);
        $('#direccion').attr('disabled',true);

    }
});

$('#switch-usuario').click(function () {
    if($('#switch-usuario').hasClass('inactivo')){
        $('#switch-usuario').removeClass('inactivo');
        $('#switch-usuario').addClass('activo');
        $('#switch-usuario').removeClass('fa-toggle-off');
        $('#switch-usuario').addClass('fa-toggle-on');

        $('#correo').prop('disabled',false);
        $('#viejaClave').prop('disabled',false);
        $('#nueva').prop('disabled',false);
        $('#confirm').prop('disabled',false);

        $('#btn-usuario').prop('disabled',false);

    }else{
        $('#switch-usuario').removeClass('fa-toggle-on');
        $('#switch-usuario').removeClass('activo');
        $('#switch-usuario').addClass('inactivo');
        $('#switch-usuario').addClass('fa-toggle-off');

        $('#correo').prop('disabled',true);
        $('#viejaClave').prop('disabled',true);
        $('#nueva').prop('disabled',true);
        $('#confirm').prop('disabled',true);

        $('#btn-usuario').prop('disabled',true);
    }

});