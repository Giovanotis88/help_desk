<?php
    if (session_status() == PHP_SESSION_NONE) {
          
           
        session_start();
        }
        
    
    if ($_SESSION["id_rol"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Nuevo_Caso\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Nuevo Caso</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Consul_Caso\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Caso</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }else if($_SESSION["id_rol"]==2){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Nuevo_Caso\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Nuevo Caso</span>
                        </a>
                    </li>

                    

                    <!-- <li class="blue-dirty">
                        <a href="..\N_Servicio\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Niveles De Servicio</span>
                        </a>
                    </li> -->

                    <!-- <li class="blue-dirty">
                        <a href="..\Categorias\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Categorias</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Sub_Categorias\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Sub Categorias</span>
                        </a-->
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Consul_Caso\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Caso</span> 
                            
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    
    }else{
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Nuevo_Caso\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Nuevo Caso</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\ConfUsuario\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Conf Usuario</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\N_Servicio\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Niveles De Servicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Categorias\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Categorias</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Sub_Categorias\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Sub Categorias</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Consul_Caso\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Caso</span>
                            
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }
?>