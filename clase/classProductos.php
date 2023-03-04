<?php
class Producto{
    private $Codigo;
    private $Nombre;
    private $Descripcion;
    private $Img;
    private $Categoria;
    private $Precio;
    private $Existencias;
    private $nomImg;
    
    public function __construct(){
        $this->Codigo = "";
        $this->Nombre = "";
        $this->Descripcion = "";
        $this->Img = "";
        $this->Categoria = "";
        $this->Precio = "";
        $this->Existencias = "";
    }

    public function IngresoDatos($code, $nom, $desc, $img, $categ, $pre, $exist){
        $this->Codigo = $code;
        $this->Nombre = $nom;
        $this->Descripcion = $desc;
        $this->Img = $img;
        $this->Categoria = $categ;
        $this->Precio = $pre;
        $this->Existencias = $exist;
    }

    public function ValidacionDatos(){
        $mensaje = "";
        if(!preg_match("/^PROD[0-9]{5}$/",$this->Codigo )){
            $mensaje .= "- Error en el Codigo Ingresado. <br>";
        }
        if(!preg_match("/^[a-zA-Z ]+$/", $this->Nombre )){
             $mensaje .= "- Error en el Nombre Ingresado. <br>";
        }
        $img_name = $_FILES['img']['name'];
        $extension = pathinfo($img_name, PATHINFO_EXTENSION);
        if($extension != "jpg" && $extension != "png" && $extension != "jpeg" ){  
             $mensaje .= "- Error en el tipo de Archivo Ingresado. <br>";
        }
        if($this->Precio < 0){ 
             $mensaje .= "- Error en el Precio Ingresado. <br>";
        }
        if($this->Existencias < 0){ 
             $mensaje .= "- Error en las Existencias Ingresado. <br>";
        }
        return $mensaje;
    }

    public function ExportImg(){
        $ruta_tmp = $_FILES['img']['tmp_name'];
        $ruta_final = "imagenes/".$this->Codigo.".png";

        // Obtener información de la imagen
        list($ancho_original, $alto_original, $tipo_imagen) = getimagesize($ruta_tmp);
        switch ($tipo_imagen) {
            case IMAGETYPE_JPEG:
                $imagen_original = imagecreatefromjpeg($ruta_tmp);
                break;
            case IMAGETYPE_PNG:
                $imagen_original = imagecreatefrompng($ruta_tmp);
                break;
            default:
                return false;
        }

        //Crear imagen con igual tamaño
        $nueva_imagen = imagecreatetruecolor($ancho_original, $alto_original);

        //Copia la imagen
        imagecopy($nueva_imagen, $imagen_original, 0, 0, 0, 0, $ancho_original, $alto_original);
        
        // Guardar la imagen
        switch ($tipo_imagen) {
            case IMAGETYPE_JPEG:
                imagejpeg($nueva_imagen, $ruta_final);
                $this->nomImg = $this->Codigo.".jpg";
                break;
            case IMAGETYPE_PNG:
                imagepng($nueva_imagen, $ruta_final);
                $this->nomImg = $this->Codigo.".png";
                break;
        }

    }

    public function RegistroXML(){
        $Productos = simplexml_load_file("Almacen.xml");
        $productoActu=$Productos->addChild("producto");
        $productoActu->addChild("codigo",$this->Codigo);
        $productoActu->addChild("nombre",$this->Nombre);
        $productoActu->addChild("descripcion",$this->Descripcion);
        $productoActu->addChild("img",$this->nomImg);
        $productoActu->addChild("categoria",$this->Categoria);
        $productoActu->addChild("precio",$this->Precio);
        $productoActu->addChild("existencias",$this->Existencias);

        file_put_contents("Almacen.xml",$Productos->asXML());
    }

    
public function EditaXML($ID){
    $Productos = simplexml_load_file("Almacen.xml");
    $index=0;
    $i=0;

    foreach($Productos->producto as $productoActu){
        if($productoActu->codigo==$ID){
            $index=$i;
            break;
        }
        $i++;
    }

    $Elegida = $Productos->producto[$index];
    $Elegida->codigo = $this->Codigo;
    $Elegida->nombre = $this->Nombre;
    $Elegida->descripcion = $this->Descripcion;
    $Elegida->img = $this->nomImg;
    $Elegida->categoria = $this->Categoria;
    $Elegida->precio = $this->Precio;
    $Elegida->existencias = $this->Existencias;

    file_put_contents("Almacen.xml",$Productos->asXML());
}

public function BorrarXML($ID){
    $Productos = simplexml_load_file("Almacen.xml");
    $index=0;
    $i=0;

    foreach($Productos->producto as $productoActu){
        if($productoActu->codigo==$ID){
            $index=$i;
            break;
        }
        $i++;
    }

    unset($Productos->producto[$index]);
    file_put_contents("Almacen.xml",$Productos->asXML());
}

}

?>