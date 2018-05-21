<div class="row">
    <div class="container-fluid main-loadd">
        <form action="">
            <div class="row riues-encabezado">
                <div class="col">
                    <h1 class="riues-font-01">
                        Contactos Personales
                    </h1>
                </div>
            </div>
            <hr>
            <div class="row riues-cuerpo">
                <table class="table table-bordered table-sm">
                    <thead class="thead-ri">
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
                            <td>Azael</td>
                            <td></td>
                            <td class="td">
                                <button type="button" class="btn btn-primary">
                                    <i class="far fa-edit fa-1x">  Editar</i>
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <i class="fas fa-recycle fa-1x"style="color: white">  Eliminar</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row riues-btn-ft justify-content-end">
                <div class="col-4"><br><br></div>
                <div class="col-4"></div>
                <div class="col-4 justify-content-end">
                    <button type="submit" class="btn riues-btn">Guardar Cambios</button>
                </div>


            </div>
        </form>
    </div>
</div>
<script  src="{{asset('js/admin001.js')}}"></script>