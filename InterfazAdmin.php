<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Interfaz de Adminostrador</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/Admin.css">
</head>
<body> 
    <!-- header -->
    <header id="AdminHeader">
        Universidad Don Bosco
    </header>

    <!-- Navegador -->
    <nav id="AdminNav">
        <a class="logo">     <span> Textil Export. </span>       </a>
        <a class="menu" href="Index.php">  <span> Inicio </span> </a>
        <a class="menu" href="InterfazAdmin.php">  <span> Productos </span> </a>
        <a class="menu" href="Informacion.php">  <span> Informacion </span> </a>
    </nav>

    <div class="container">
    <h1 class="page-header text-center">Productos Registrados</h1>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2" id="MainDiv">
        <?php
            $Errores = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['Errores'] : null;
            $CodigoDato = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Editar" ? $_POST['CodigoDato'] : null;
            $Errores2 = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Editar" ? $_POST['Errores2'] : null;

            if($Errores != null){
                echo "<div class='divErroresMain'> 
                        <span class='glyphicon glyphicon-remove'></span> <span class='txtErrores'>Error en el Registro de Nuevo Producto </span>
                    </div>";
            }else if($Errores2 != null){
                echo "<div class='divErroresMain'> 
                <span class='glyphicon glyphicon-remove'></span> <span class='txtErrores'>Error en el Editar de un Producto</span>
                    </div>";
            }
        
        ?>
            <a href="#addnew" class="btn btn-primary" data-toggle="modal">
                <span class="glyphicon glyphicon-plus"></span> Registrar Producto</a>
            
            <table id="ProductTable" class="table table-bordered table-striped" style="margin-top:20px;">
        <thead id="tableTH">
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>Categoria</th>
            <th>Precio</th>
            <th>Existencias</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php
            $productos= simplexml_load_file("Almacen.xml");
            foreach ($productos->producto as $productoActual){
                echo "<tr>
                        <td class='tdPequeno'>$productoActual->codigo </td>
                        <td class='tdPequeno'>$productoActual->nombre </td>
                        <td class='tdGrande'>$productoActual->descripcion</td>
                        <td class='tdMedio'><img class='ProductImg' src='imagenes/".$productoActual->img."' alt=".$productoActual->img."> </td>
                        <td class='tdPequeno'>$productoActual->categoria</td>
                        <td class='tdPequeno'>$$productoActual->precio</td>
                        <td class='tdPequeno'>$productoActual->existencias</td>
                        <td class='tdGrande'>
                            <a href='#editar_".$productoActual->codigo."' data-toggle='modal'' class='btn btn-primary'>Editar</a>
                            <a href='#borrar_".$productoActual->codigo."' data-toggle='modal'  class='btn btn-danger'>Eliminar</a>
                            </td>
                
                    </tr>";
                    include('modales/modal_Borrar.php');
                    include('modales/modal_Editar.php'); 
            }
            
            ?>                
        </tbody>
    </table>

        </div>
    </div>
</div>
<?php include('modales/modal_Registrar.php'); ?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>