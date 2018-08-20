$( function() {
    $ ('#frm-agregar').dialog({
            autoOpen: false,
            height: 700,
            width: 675,
            modal:true,
            resizable:false,
            //appendTo:"#seleccionable",

            classes: {
                "ui-dialog": "my",
                "ui-dialog-titlebar":"frm-modal-title",
                "ui-dialog-buttonpane":"db"
            },
            buttons: [
                {
                    text: " Guardar ",
                    class:"boton-rojo-riues",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                },
                {
                    text: "Cancelar",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        }
    );
} );

$( "#btn-agregar" ).click(function( event ) {
    $( "#frm-agregar" ).dialog( "open" );
    event.preventDefault();
});


$( function() {
    $("#fechaInicio,#fechafin").datepicker();
} );