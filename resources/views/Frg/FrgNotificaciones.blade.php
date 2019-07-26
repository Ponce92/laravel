<div class="col-ms-12">
    @if (count($ntfs)>0)
        @foreach ($ntfs as $ntf)
            <div class="row ntf-row" onclick="loc('{{route('notificaciones')}}')">
                    <div class="col-2">
                        <img src="{{asset('avatar/'.$ntf->getRemitente()->getFoto())}}" width="45" height="45" class="rounded-circle" alt="No imgage">
                    </div>
                    <div class="col-10">

                        <p style="font-size:14px; color:rgb(110,110,110);">
                            {{$ntf->getRemitente()->getCorreo()}}
                            {{$ntf->rt_tipo_notificacion =='SRI' ? 'Ha solicitado registrarse en el sistema.':''}}
                            {{$ntf->rt_tipo_notificacion =='SRA' ? 'Ha solicitado reactivar su cuenta.':''}}
                            {{$ntf->rt_tipo_notificacion =='RSR' ? 'Ha acpetado tu solicitud':''}}
                        {{--
                        Solicituede de amistad
                        --}}
                            {{$ntf->rt_tipo_notificacion =='SSA' ? 'ha solicitado agregarte a sus contactos':''}}
                            {{$ntf->rt_tipo_notificacion =='RSA' ? 'ha acpetado tu solicitud de contacto':''}}
                            @if($ntf->getTipo() =='SAI')
                                Te ha invitado a participar en el proyecto :
                                    {{$ntf->getProyecto()->getTitulo()}}
                            @endif
                            {{$ntf->rt_tipo_notificacion =='RAP' ? 'Ha acpetado tu invitacion  a proyecto':''}}

                            @if($ntf->getTipo() =='SPP')
                                ha solicitado participar en el proyecto
                                    {{$ntf->getProyecto()->getTitulo()}}

                            @endif
                            @if($ntf->getTipo() =='RPP')

                                    {{$ntf->getProyecto()->getTitulo()}}

                            @endif
                        </p>
                    </div>
            </div>
            <hr style="margin-top:1px;margin-bottom: 1px;" class="all">
        @endforeach
    @else
        <div class="row justify-content-center">
            <strong>No tienes notificaciones nuevas</strong>
        </div>
    @endif

</div>
<script type="text/javascript">
    function loc(url) {
        location.href=url;
    }
</script>
<style media="screen">
.ntf-row{
    padding-top: 5px;
}
.ntf-row:hover{
    background-color: rgba(220,220,220);
    cursor: pointer;
}
</style>
