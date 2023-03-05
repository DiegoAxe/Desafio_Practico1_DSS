<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    

    <title>Textil Export</title>
  </head>
  <body>
    <!--Encabezado -->
    <header class="container-fluid bg-secondary d-flex justify-content-center">
    <p class="text-light mb-0 p-2 fs-4 fw-bold">Universidad Don Bosco</p>
    </header>
    <!--Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 fw-bold" id="menu">
        <div class="container-fluid">
          <a class="navbar-brand">
            <span class="text-black-50 fs-5 fw-bold">Textil Export.</span> 
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="Index.php ">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="InterfazAdmin.php">Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Informacion.php">Informacion</a>
              </li>
              
              <form class="d-flex" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input class="form-control me-2" type="search" placeholder="Buscar" name="filtro" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Buscar</button>
        <button class="btn btn-secondary ms-2" type="submit" name="quitar-filtro">Quitar filtro</button>
</form>

<?php if(!empty($filtro)) : ?>
        <button class="btn btn-secondary ms-2" type="submit" name="quitar-filtro">Quitar filtro</button>
    <?php endif; ?>

          </div>
        </div>
      </nav>

      <!-- TITULO -->
      <div class="container-fluid bg-light d-flex justify-content-center">
      <p class="text-dark mb-0 p-5 fs-1 fw-bold">Listado de productos</p>
      </div>
      
    <!-- Ventana Modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p><strong>Nombre:</strong> <span id="detalles-nombre"></span></p>
        <p><strong>Código:</strong> <span id="detalles-codigo"></span></p>
        <p><strong>Categoría:</strong> <span id="detalles-categoria"></span></p>
        <p><strong>Descripción:</strong> <span id="detalles-descripcion"></span></p>
        <p><strong>Precio:</strong> $<span id="detalles-precio"></span></p>
        <p><strong>Existencias:</strong> <span id="detalles-existencias"></span></p>
        <p><strong>Estado:</strong> <span id="detalles-estado"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Entendido</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Listado de productos -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <div class="productos">
<?php
$xml = simplexml_load_file('Almacen.xml');

// Obtener la palabra clave ingresada por el usuario
$filtro = isset($_POST['filtro']) ? $_POST['filtro'] : '';

// Verificar si se ha enviado la acción "quitar filtro"
if(isset($_POST['quitar-filtro'])) {
    // Redirigir a la página actual sin filtro
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

foreach($xml->children() as $producto){
    // Verificar si el producto coincide con la palabra clave de búsqueda
    if(empty($filtro) || stripos($producto->nombre, $filtro) !== false) {

      echo ' <div class="list-group mt-4 d-flex">
            <a href="#" class="list-group-item list-group-item-action detalles-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-codigo="'.$producto->codigo.'" data-nombre="'.$producto->nombre.'" data-descripcion="'.$producto->descripcion.'" data-categoria="'.$producto->categoria.'" data-precio="'.$producto->precio.'" data-existencias="'.$producto->existencias.'">
              <div class="d-flex">
                <div class="p-2">
                  <img src="' . 'imagenes/' . $producto->img . '" class="img-thumbnail" width="250" alt="' . $producto->nombre . '">
                </div>
                <div class="d-flex flex-column align-items-start justify-content-between p-2">
                  <h5 class="mb-1">'.$producto->nombre.'</h5>
                  <p class="mb-1">Informacion del producto: <br>'.$producto->descripcion.'</p>
                  <button type="button" class="btn btn-primary detalles-btn" data-bs-toggle="modal" 
                    data-bs-target="#exampleModal" data-codigo="'.$producto->codigo.'" 
                    data-nombre="'.$producto->nombre.'" data-descripcion="'.$producto->descripcion.'" 
                    data-categoria="'.$producto->categoria.'" data-precio="'.$producto->precio.'" 
                    data-existencias="'.$producto->existencias.'">
                  Más Información</button>
                </div>
              </div>
            </a>
          </div>';
    }
}
?>


    </div>
    <script src="assets/js/script.js"></script>
     <!-- footer -->
  <footer class="bg-dark py-5 mt-5">
    <div class="container text-light text-center">
    <p class="display-5 mb-3">Textil Export</p>
    <small class="text-white-50"> &copy; Copyright by Diego Ariel Martinez Lemus & Cristian Alexis Lopez Tamayo. All rights reserved </small>
    </div>
  </footer>
  </body>
</html>
