@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
@include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <h2 class="titulo-seccion">Proyectos Realizados</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    <button id="btn-agregar" class="boton-rojo-riues">Agregar</button>
                </div>

            </div>
            <hr style="margin-bottom: 2px;margin-top: 0px;">
        </div>
        <br>
        <div class="row tarjeta align-items-center">
            <div class="col-2 img-p ">
                <div class="row justify-content-center">
                        <i class="fab fa-codepen fa-5x "></i>
                </div>

            </div>

            <div class="col-8 descripcion">
                <h3>Nombre del proyecto</h3>
                <h5>Desde : -5-6-7 hasta 0-03-30</h5>
                <h5>Decscripcion: llofa adsofnaosid faosdfndlafnasldf</h5>

            </div>
            <div class="col-1" >
                <i class="fas fa-trash-alt fa-2x fa-button" ></i>
            </div>
            <div class="col-1 ">
                <i class="fas fa-edit fa-2x fa-button"></i>
            </div>

        </div>

        <div class="row" hidden>{{-- ..............Definicion de formularios para jqueyry ui .................. --}}

            <div id="frm-agregar" title="Agregar Proyecto Realizado">
                <br>
                <form class="agergarProyecto" action="#">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nombreProyecto">Nombre del Proyecto :</label>
                                <input type="text" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="fechaIncicio">Fecha Incicio :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <input type="text" class="form-control" id="fechaInicio">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="fechaFin">Fecha Finalizacion:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <input type="text" class="form-control" id="fechafin">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <br>
                            <label for="descripcion">Area Conocimiento</label>
                            <select name="area" id="area" class="form-control">
                                <option value="afsd">Area de concocimiento</option>
                            </select>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="descripcion">Descripcion:</label>
                            <br>
                            <textarea rows="5" cols="60" placeholder="Descripcion..."></textarea>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection


@section('js')
    <script  src="{{asset('js/ProyectosRealizados.js')}}"></script>
@endsection