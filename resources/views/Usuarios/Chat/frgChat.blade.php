
@if(count($Mensajes)>0)
<div id="msj-destino" destinatario='{{$usr->getId()}}' hidden></div>

    @foreach($Mensajes as $msj)
    @if($msj->getRemitente()->getId() == $user->getId())
    <div class="row justify-content-end">
            <div class="col-md-5">
                <div class="row justify-content-end">
                    <div class="divMsj blueMsj">
                        <p class="p">
                                {{$msj->getTexto()}}
                        </p>
                    </div>
                </div>
            </div>
            <img src="{{asset('avatar/'.$usr->getFoto() )}}" width="40" height="40" class="rounded-circle" alt="">
        </div>    
    @else
    <div class="row justify-content-start align-items-center">
            <img src="{{asset('avatar/'.$user->getFoto() )}}" width="40" height="40" class="rounded-circle" alt="">
            <div class="col-md-5">
                <div class="row">
                    <div class="divMsj witheMsj">
                        <p class="p">
                            {{$msj->getTexto()}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endforeach
            

@else
<div id="msj-destino" destinatario='{{$usr->getId()}}' hidden></div>
    <div class="row justify-content-center">
        <p style="color:#aa0000;font-size:16px;"> 'Comienza a conversar con este usuario'</p>
    </div>
@endif