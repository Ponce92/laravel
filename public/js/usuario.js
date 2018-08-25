$('#switch-usuario').click(function () {

    if($('#switch-usuario').hasClass('inactivo')){
        $('#switch-usuario').removeClass('inactivo');
        $('#switch-usuario').addClass('activo');
        $('#switch-usuario').removeClass('fa-toggle-off');
        $('#switch-usuario').addClass('fa-toggle-on');

        $('#viejoPassword').prop('disabled',false);
        $('#password').prop('disabled',false);
        $('#password_confirmation').prop('disabled',false);

        $('#btn-usuario').prop('disabled',false);

    }else{
        $('#switch-usuario').removeClass('fa-toggle-on');
        $('#switch-usuario').removeClass('activo');
        $('#switch-usuario').addClass('inactivo');
        $('#switch-usuario').addClass('fa-toggle-off');

        $('#viejoPassword').prop('disabled',true).removeClass("is-invalid");
        $('#password').prop('disabled',true).removeClass("is-invalid");
        $('#password_confirmation').prop('disabled',true).removeClass("is-invalid");

        $('#btn-usuario').prop('disabled',true);
        $('.invalid-feedback').html('');
        $('.alert-danger').remove();
    }

});