
$( function() {
    $ ('#dialog1').dialog({
            autoOpen: false,
            height: 500,
            width: 375,
            modal: true,
            appendTo:"#seleccionable",
        classes: {
            "ui-dialog": "my",
            "ui-dialog-titlebar":"title",
            "ui-dialog-buttonpane":"db"
        },
        buttons: [
                {
                    text: "Guardar",
                    click: function() {
                    $( this ).dialog( "close" );
                    }
                },
            {
                text: "Cancelar",
                class:"riues-btn",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
        }
    );
} );

$( "#btn-open-form001" ).click(function( event ) {
    $( "#dialog1" ).dialog( "open" );
    event.preventDefault();
});
