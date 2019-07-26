<div id="seleccionable" class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-home">
                    </i>
                    Inicio
                </a>
            </li>

            <li class="nav-title" style="text-align: center;">  RIUES </li>

            <li class="divider"></li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wrench"></i>Perfil</a>
                <ul class="nav-dropdown-items">

                    <li class="nav-item"   >
                        <a class="nav-link"
                           href="{{ route('gestionDatosPersonales') }}"
                           >
                            <i class="nav icon icon-list"></i> Datos Personales
                        </a>
                    </li>
                    @if($user->fk_id_rol != 0)
                        <li class="nav-item"   >
                            <a  class="nav-link"
                                href="{{ route('gestionProyectosRealizados') }}"
                            >

                                <i class="nav icon icon-list"></i> Trayectoria
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('verPublicaciones') }}">
                                <i class="nav icon icon-list"></i>Publicaciones
                            </a>

                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('verUsuario') }}">
                            <i class="nav icon icon-list"></i> Usuario
                        </a>

                    </li>
                </ul>
            </li>

            @if($user->fk_id_rol != 0 )
                @if($user->fk_id_estado ==1 )

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link" href="{{route('getPerfilesInvestigadores')}}">
                            <i class="icon-people"></i>Investigadores
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="icon-rocket"></i>Proyectos</a>
                        <ul class="nav-dropdown-items">

                            <li class="nav-item"   >
                                <a class="nav-link"
                                   href="{{ route('misproyectos.investigacion') }}"
                                >
                                    <i class="nav icon icon-list"></i> Mis Proyectos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('Busqueda.Proyectos') }}">
                                    <i class="nav icon icon-list"></i> Busqueda
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-share"></i>Redes</a>
                        <ul class="nav-dropdown-items">

                            <li class="nav-item"   >
                                <a class="nav-link" href="{{ route('redes.todas') }}">

                                    <i class="nav icon icon-list"></i> Mis Redes
                                </a>
                            </li>

                            <li class="nav-item"   >
                                <a class="nav-link" href="{{ route('redes.busqueda') }}">
                                    <i class="nav icon icon-list"></i> Busqueda
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('foros')}}"><i class="icon-people"></i>Foros</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('chat')}}"><i class="icon-bubble"></i>Chat</a>
                    </li>

                @endif
            @endif


            @if($user->fk_id_rol==0)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>Investigadores</a>
                    <ul class="nav-dropdown-items">

                        <li class="nav-item"   >
                            <a class="nav-link" href="{{ route('gestionRegistrosInv') }}">

                                <i class="nav icon icon-list"></i> Registros
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-settings"></i>Ajustes
                    </a>
                    <ul class="nav-dropdown-items">

                        <li class="nav-item"   >
                            <a class="nav-link" href="{{ route('ajustes.paises') }}">

                                <i class="nav icon icon-list"></i> Paises
                            </a>
                        </li>
                        <li class="nav-item"   >
                            <a class="nav-link" href="{{ route('grados') }}">

                                <i class="nav icon icon-list"></i> Grados academicos
                            </a>
                        </li>
                    </ul>
                </li>
        @endif

            @if($user->fk_id_estado==1 || $user->fk_id_rol== 0)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="{{route('notificaciones')}}">
                        <i class="icon-bell"></i>Notificaciones

                        @if(isset($ntf))
                            @if($ntf>0)
                                <span class="badge badge-danger">{{$ntf}}</span>
                            @endif

                        @endif

                    </a>
                </li>
            @endif

            <li class="nav-item mt-auto">
            </li>
            <li class="nav-item" style="background-color: #aa0000;font-weight: bold;" >
                <a class="nav-link" href="{{ route('logout') }}" target="_top"><i class="fas fa-power-off fa-4x" style="color: white"></i> Cerrar Sesion</a>
            </li>

        </ul>
    </nav>

</div>
