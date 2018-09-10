
@extends('layouts.app')

@section('content')
    <br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-4">
            <div class="card">

                <div class="card-header" style="background-color: #aa0000;color: white;font-weight: bold; ">Restablecimiento de credenciales</div>

                <div class="card-body">

                    @if (session('status'))
                        <br>
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <label for="email">E-Mail Address </label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block" style="color:red;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
