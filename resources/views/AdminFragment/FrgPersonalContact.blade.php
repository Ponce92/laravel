<div class="row">
    <div class="container-fluid main-loadd">
            <div class="row riues-encabezado">
                <div class="col">
                    <h2 class="riues-font-01">
                        Contactos Personales
                    </h2>
                </div>
            </div>
            <hr>
            <div class="row riues-cuerpo table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Tipo Contacto</th>
                            <th class="td" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td>1</td>
                            <td>7056-6420</td>
                            <td>Telefono</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary">
                                        <i class="far fa-edit fa-1x">  Editar</i>
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <i class="fas fa-recycle fa-1x"style="color: white">  Eliminar</i>
                                    </button>
                                </div>


                            </td>
                        </tr>
                        <tr scope="row">
                            <td>1</td>
                            <td>7056-6420</td>
                            <td>Telefono</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary">
                                        <i class="far fa-edit fa-1x">  Editar</i>
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <i class="fas fa-recycle fa-1x"style="color: white">  Eliminar</i>
                                    </button>
                                </div>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>

            <div class="row riues-btn-ft">
                <div class="col-3 offset-8">
                    <div class="row justify-content-end">
                        <button id="btn-open-form001" type="submit" class="btn btn-success">Nuevo contacto</button>
                    </div>
                </div>

            </div>
        <div hidden>
            <div id="dialog1" title="Agregar Contacto" style="width: 600px;">
                <fomr>
                    <div class="form-group">
                        <label for="nombreContacto">Valor</label>
                        <input  class="form-control"
                                type="text"
                                id="NombreContacto"
                        >
                    </div>
                    <div class="form-group">
                        <label for="TipoContacto"></label>
                        <select name="Tipocontacto" id="TipoContacto" class="form-control">
                            <option value="telefono" selected="true">Telefono</option>
                            <option value="email">Correo Electronico</option>
                        </select>
                    </div>
                </fomr>
            </div>
            <di class="dialog-alert">

            </di>
        </div>

    </div>
    <br><br>
</div>
<script  src="{{asset('js/admin001.js')}}"></script>