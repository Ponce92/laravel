<div id="seleccionable" class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html"><i class="icon-speedometer"></i> Inicio</a>
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
                <!-Opcion del menu Gestion de perfil -->
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>Perfil</a>
                <ul class="nav-dropdown-items">

                    <li class="nav-item"   >
                        <a class="nav-link"
                           href="{{ route('gestionDatosPersonales') }}"
                           >
                            <i class="fas fa-address-card"></i> Datos Personales
                        </a>
                    </li>

                    <li class="nav-item"   >
                        <a  class="nav-link"
                            href="{{ route('gestionProyectosRealizados') }}"
                        >

                            <i class="fas fa-address-book"></i> Proyectos Realizados
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('gestionPublicaciones') }}">
                            <i class="fas fa-address-book"></i>Publicaciones
                        </a>

                    </li>

                </ul>
            </li>
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
            <li class="nav-item">
                <a class="nav-link nav-link-danger" href="{{ route('logout') }}" target="_top"><i class="fas fa-power-off fa-4x"></i> Cerrar Sesion</a>
            </li>

        </ul>
    </nav>

</div>