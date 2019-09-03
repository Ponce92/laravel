<div class="row">
    <div class="container-fluid main-loadd">
        <form action="">
            <div class="row riues-encabezado">
                <div class="col">
                    <h2 class="riues-font-01">
                        Detalle de Perfil
                    </h2>
                </div>
            </div>
            <hr>
            <div class="row riues-cuerpo">
                <div class="col-12">
                        <h5 class="riues-font-01">Nombre</h5>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="nombre">Nombre</label>
                                <input type="text"
                                       class="form-control"
                                        id="nombre_txt">
                            </div>
                            <div class="col-6">
                                <label for="apellido">Apellido</label>
                                <input type="text"
                                        class="form-control"
                                        id="apellido">
                            </div>
                        </div>
                    <br>
                </div>
            </div>
            <hr>
            <div class="row riues-cuerpo">
                <div class="col-12">
                    <h5 class="riues-font-01">Dirección</h5>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text"
                                       class="form-control"
                                       id="direccion">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="pais">País</label>
                            <div class="input-group">
                                <input type="text"
                                       class="form-control" disabled
                                        value="El Salvador">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row riues-cuerpo">
                <div class="col-12">
                    <h5 class="riues-font-01">Otros</h5>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="grado">Área de Conocimiento</label>
                            <input type="text"
                                   class="form-control"
                                   disabled
                                   value="Area del conocimiento">
                        </div>
                        <div class="col-4">
                            <label for="fecha">Fecha Nacimiento</label>
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       disabled
                                       value="DD-MM-AA">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-4">
                            <label for="horas">Horas de investigación</label>
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       value="DD-MM-AA"
                                        id="horas">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
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