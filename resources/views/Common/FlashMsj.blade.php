@if(session('success'))
    <div class="alert alert-success msj">
        <i class="fas fa-check"></i>
        &nbsp;&nbsp;
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('info'))
    <div class="alert alert-info msj">
        <i class="fas fa-info-circle">&nbsp;</i>&nbsp;&nbsp;
        {{session('info')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('danger'))
    <div class="alert alert-danger msj">
        <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;
        {{session('danger')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif