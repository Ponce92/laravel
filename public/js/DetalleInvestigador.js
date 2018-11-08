function resetTabs(){
    $("#content > div").hide(); //Hide all content
    $("#tabs a").attr("id",""); //Reset id's
}

var myUrl = window.location.href; //get URL
var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2
var myUrlTabName = myUrlTab.substring(0,4); // For the above example, myUrlTabName = #tab

(function(){
    $("#content > div").hide(); // Initially hide all content
    $("#tabs li:first a").attr("id","current"); // Activate first tab
    $("#content > div:first").fadeIn(); // Show first tab content

    $("#tabs a").on("click",function(e) {
        e.preventDefault();
        if ($(this).attr("id") == "current"){ //detection for current tab
            return
        }
        else{
            resetTabs();
            $(this).attr("id","current"); // Activate this
            $($(this).attr('name')).fadeIn(); // Show content for current tab
        }
    });

    for (i = 1; i <= $("#tabs li").length; i++) {
        if (myUrlTab == myUrlTabName + i) {
            resetTabs();
            $("a[name='"+myUrlTab+"']").attr("id","current"); // Activate url tab
            $(myUrlTab).fadeIn(); // Show url tab content
        }
    }
})()
/*
 *
 */

function verProyecto(element) {
    var url=element.getAttribute('name');
    var id=element.getAttribute('id');

    getDetalleP(id,url);
}

function getDetalleP(id,url) {
    $.ajax({
        type: "get",
        url: url,
        data: {id: id},
        success: function( prj )
        {
            mostrarFormEdtPr(prj[0]);
        }
    });
}

function mostrarFormEdtPr(prj) {
    $('#nombre').val(prj.rt_titulo_proyecto);
    $('#fechaInicio').val(prj.rf_fecha_inicio_proyecto);
    $('#fechafin').val(prj.rf_fecha_fin_proyecto);
    $('#area-e').append('<option selected value="'+prj.pk_id_area+'"+ >'+prj.rt_nombre_area+' </option>');

    $('#textarea').val(prj.rd_descripcion_proyecto);

    $( "#frm-proj" ).dialog("open");
}

$( function() {
    $ ("#frm-proj").dialog({
            autoOpen: false,
            height: 700,
            width: 675,
            modal:true,
            resizable:false,
            draggable:false,
            classes: {
                "ui-dialog": "my",
                "ui-dialog-titlebar":"frm-modal-title",
                "dialogClass": 'hide-close',
            },
            open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
            buttons: [
                {
                    text: "Cerrar",
                    click: function()
                    {
                        $(this).dialog('close');
                    }
                }
            ]
        }
    );
} );

/*
*       Seccion de ver las Publicacioens del perfil que se observa
* */

$( function() {
    $ ("#editar-frm").dialog({
            autoOpen: false,
            height: 725,
            width: 675,
            modal:true,
            resizable:false,
            draggable:false,
            classes: {
                "ui-dialog": "my",
                "ui-dialog-titlebar":"frm-modal-title",
                "dialogClass": 'hide-close',
            },
            open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
            buttons: [
                {
                    text: "Cerrar",
                    click: function()
                    {
                        $(this).dialog('close');
                    }
                }
            ]
        }
    );
} );

function mostrarFormEdit(prj) {

    $('#id_pu').val(prj.pk_id_publicacion);
    $('#titulo-edt').val(prj.rt_titulo_publicacion);
    $('#fecha-edt').val(prj.rf_fecha_publicacion);

    $('#descripcion-edt').val(prj.rd_descripcion_publicacion);
    $("#enlace-edt").val(prj.rt_enlace_publicacion);
    $("option[value="+prj.fk_id_area+"]").attr('selected',true);
    $("#tipo-edt option").each(function(){
        var valor=$(this).val();

        if (valor==prj.rt_tipo_publicacion){
            $(this).attr('selected',true);
        }
    });


    $( "#editar-frm" ).dialog("open");
}

function verPublicacion(element) {
    var url=element.getAttribute('name');
    var id=element.getAttribute('id');

    getDetalle(id,url);
    //var data=getDetalle(parseInt(element.id));

}

function getDetalle(id,url) {
    $.ajax({
        type: "get",
        url: url,
        data: {id: id},
        success: function( prj )
        {
            mostrarFormEdit(prj[0]);
        }
    });
}


/*-----------------------------------------------------------------------------------------------
 *      |   menus de investigador
 *-----------------------------------------------------------------------------------------------
 *
 */

$('#opciones-menu-click').webuiPopover({
    width:350,
    trigger:'click',
    padding:0
});