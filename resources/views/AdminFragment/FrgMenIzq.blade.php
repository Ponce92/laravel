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

            <li class="nav-title">RIUES </li>
            <li class="divider"></li>

            <!--
            <li class="nav-item">
                <a href="colors.html" class="nav-link"><i class="icon-drop"></i> Colors</a>
            </li>
            <li class="nav-item">
                <a href="typography.html" class="nav-link">
                    <i class="icon-pencil"></i> Typograhy</a>
            </li>
            -->
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>Perfil</a>
                <ul class="nav-dropdown-items">

                    <li class="nav-item"   >
                        <a class="nav-link"
                           href="{{ route('gestionDatosPersonales') }}"
                           >
                            <i class="cui-settings icons font-2xl"></i> Datos Personales
                        </a>
                    </li>
                    @if($user->fk_id_rol != 0)
                        <li class="nav-item"   >
                            <a  class="nav-link"
                                href="{{ route('gestionProyectosRealizados') }}"
                            >

                                <i class="fas fa-address-book"></i> Proyectos Realizados
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('verPublicaciones') }}">
                                <i class="fas fa-address-book"></i>Publicaciones
                            </a>

                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('verUsuario') }}">
                            <i class="fas fa-user-edit"></i> Usuario
                        </a>

                    </li>
                </ul>
            </li>

            {{--<li class="nav-item nav-dropdown">--}}
                {{--<a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>Perfil</a>--}}
                {{--<ul class="nav-dropdown-items">--}}
                    {{--<li>--}}
                        {{----}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}


            @if($user->fk_id_rol != 0 )
                @if($user->fk_id_estado ==1 )

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link" href="{{route('getPerfilesInvestigadores')}}">
                            <i class="icon-people"></i>Investigadores
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>Proyectos</a>
                        <ul class="nav-dropdown-items">

                            <li class="nav-item"   >
                                <a class="nav-link"
                                   href="{{ route('misproyectos.investigacion') }}"
                                >
                                    <i class="cui-settings icons font-2xl"></i> Mis Proyectos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('Busqueda.Proyectos') }}">
                                    <i class="fas fa-user-edit"></i> Busqueda
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>Redes</a>
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
        @endif
            @if($user->fk_id_estado==1 || $user->fk_id_rol==0)
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





            <!--
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-cursor"></i> Buttons</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="buttons-buttons.html"><i class="icon-cursor"></i> Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buttons-button-group.html"><i class="icon-cursor"></i> Buttons Group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buttons-dropdowns.html"><i class="icon-cursor"></i> Dropdowns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buttons-social-buttons.html"><i class="icon-cursor"></i> Social Buttons</a>
                    </li>
                </ul>
            </li>
           -->

            <!--
                /*
                 *Boton de logout de la pagina.................................|
                 */
            -->
            <li class="nav-item mt-auto">
            </li>
            <li class="nav-item" style="background-color: #aa0000;font-weight: bold;" >
                <a class="nav-link" href="{{ route('logout') }}" target="_top"><i class="fas fa-power-off fa-4x" style="color: white"></i> Cerrar Sesion</a>
            </li>

        </ul>
    </nav>

</div>