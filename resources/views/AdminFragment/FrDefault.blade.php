<div class="card-deck">
    <div class="card text-center" onclick="location.href = '{{ route('gestionDatosPersonales') }}'">
        <div class="card-header">
            <i class="fas fa-cogs fa-7x" style="color: #9370DB;"></i>
        </div>
        <div class="card-body">
            <a href = "{{ route('gestionDatosPersonales') }}"><h5 class="card-title">Administración de perfil</h5></a>
        </div>
    </div>

    <div class="card text-center" onclick="location.href = '{{ route('misproyectos.investigacion') }}'">
        <div class="card-header">
            <i class="fab fa-accusoft fa-7x" style="color: #00BFFF;"></i>
        </div>
        <div class="card-body" >
           <a href = "{{ route('misproyectos.investigacion') }}"><h5 class="card-title ">Administración de Proyectos</h5></a>
        </div>
    </div>

    <div class="card text-center">
        <div class="card-header">
            <i class="fas fa-cogs fa-7x" style="color: #aa0000;"></i>
        </div>
        <div class="card-body">
            <h5 class="card-title">Administración de contactos</h5>
        </div>
    </div>
</div>