@extends('layouts.app')

@section('content')
    <br>
<div class="container-fluid">
    <div class="row">
        <div class="col-4 offset-4">
            <div class="card">
                <div class="card-header" style="background-color: #aa0000;color: white;font-weight: bold">Restablecimiento de Credenciales</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="alert">
                    Su restablecimiento de credenciales ha concluído de forma exitosa.
                </div>


                </div>
                <div class="card-footer align-content-center">
                        <a href="/dashboard" class="">
                            <button class="btn btn-primary">
                                Ok.
                            </button>
                        </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
