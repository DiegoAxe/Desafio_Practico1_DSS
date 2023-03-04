<?php
require "clase/classProductos.php";
$proceso = isset($_GET['proceso']) ? $_GET['proceso'] : "";
$IdProducto = isset($_GET['codigo']) ? $_GET['codigo'] : "";

if($proceso=="registrar")
{
    extract($_POST);
    $img = isset($_FILES['img']) ? $_FILES['img'] : null;
    $productos = new Producto();
    $productos->IngresoDatos($codigo, $nombre, $desc, $img, $categ, $precio, $exist);
    $Errores= $productos->ValidacionDatos();
    if($Errores == ""){
        //Parte donde el usuario ingreso todo correcto
        $productos->ExportImg();
        $productos->RegistroXML();
        header("location:InterfazAdmin.php");
    }else{
        $OptElegida = "Registrar";
        //Parte donde el usuario se equivoco en algun dato
        echo "
        <form name='reenvio' action='InterfazAdmin.php' method='post'>
            <input type='hidden' name='codigo'value='$codigo'>
            <input type='hidden' name='nombre'value='$nombre'>
            <input type='hidden' name='desc'value='$desc'>
            <input type='hidden' name='categ'value='$categ'>
            <input type='hidden' name='precio'value='$precio'>
            <input type='hidden' name='exist'value='$exist'>
            <input type='hidden' name='Errores'value='$Errores'>
            <input type='hidden' name='OptElegida'value='$OptElegida'>
        </form>
        <script>
        window.onload=function(){
            document.forms['reenvio'].submit();
            }
        </script>";
    }

}else if($proceso == "borrar" && $IdProducto != ""){

    $productos = new Producto();
    $productos->BorrarXML($IdProducto);
    header("location:InterfazAdmin.php");

}else if($proceso == "editar" && $IdProducto != ""){

    extract($_POST);
    $img = isset($_FILES['img']) ? $_FILES['img'] : null;
    $productos = new Producto();
    $productos->IngresoDatos($codigo, $nombre, $desc, $img, $categ, $precio, $exist);
    $Errores= $productos->ValidacionDatos();
    if($Errores == ""){
        //Parte donde el usuario ingreso todo correcto
        $productos->ExportImg();
        $productos->EditaXML($IdProducto);
        header("location:InterfazAdmin.php");
    }else{
        $OptElegida = "Editar";
        //Parte donde el usuario se equivoco en algun dato
        echo "
        <form name='reenvio' action='InterfazAdmin.php' method='post'>
            <input type='hidden' name='CodigoDato'value='$IdProducto'>
            <input type='hidden' name='Errores2'value='$Errores'>
            <input type='hidden' name='OptElegida'value='$OptElegida'>
        </form>
        <script>
        window.onload=function(){
            document.forms['reenvio'].submit();
            }
        </script>";
    }
    
}

?>