<div    class="callout callout-primary m-0 py-3"
        id="messages"
        url="{{route('chat.load')}}"
        role="tabpanel">
    @if(count($contactos) > 0)
        <hr class="rh">
        @foreach ($contactos as $am)
            <div    class="message"
                    id="usr-{{$am->getUser($user->getId())->getId()}}"
                    onclick="loadDivMjs('{{$am->getUser($user->getId())->getId()}}')"
                    style="overflow: hidden; height:50px;">
                <div class=" mr-3 float-left">
                    <div class="avatar">
                        <img src="{{asset('avatar/'.$am->getUser($user->getId())->getFoto())}}" class="img-avatar" alt="admin@bootstrapmaster.com">
                        {{-- <span class="avatar-status badge-success"></span> --}}
                    </div>
                </div>
                <div>
                    <small class="text-muted" >
                        {{$am->getUser($user->getId())->getCorreo()}}
                    </small>
                    <br>
                    {{-- <small class="text-muted">
                        {{count($am->getMensajes())>0 ? $mensajes->last()->getTexto():'Saluda a este usuario . . . !'}}
                    </small> --}}
                </div>
                {{-- <small class="text-muted float-right mt-1" style="display:block">1:52 PM</small> --}}
            </div>
            <hr class="rh">
        @endforeach

    @else
        .....
    @endif
</div>
