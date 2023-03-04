<!-- Modal de registrar nuevo Producto -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4></center>
            </div>
            <div class="modal-body">
			<?php
             
			 $codigo = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['codigo'] : "";
			 $nombre = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['nombre'] : "";
			 $desc = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['desc'] : "";
			 $categ = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['categ'] : "Textil";
			 $precio = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['precio'] : 0;
			 $exist = isset($_POST['OptElegida']) && $_POST['OptElegida'] == "Registrar" ? $_POST['exist'] : 0; 
			 if($Errores != null){
				 echo "<div class='divErrores'> 
					 <p> $Errores </p>
				 </div>";
			 }
		 ?>
			<div class="container-fluid">
			<form action="Proceso.php?proceso=registrar" method="post" enctype="multipart/form-data">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Codigo">Codigo:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="codigo" id="Codigo" value="<?= $codigo ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Nombre">Nombre:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nombre" id="Nombre" value="<?= $nombre ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Descripcion">Descripción:</label>
					</div>
					<div class="col-sm-10">
						<textarea rows="5" class="form-control" name="desc" id="Descripcion" required><?= $desc ?></textarea>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Img">Imagen:</label>
					</div>
					<div class="col-sm-10">
                    <input class="form-control" id="Img" type="file" name="img" accept="image/png, image/jpeg" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Categoria">Categoria:</label>
					</div>
					<div class="col-sm-10">
                    <select class="select_categ" id="Categoria" name="categ">
                        <option value="Textil" <?php if($categ === "Textil"){echo "selected";} ?> > Textil </option>
                        <option value="Promocional" <?php if($categ === "Promocional"){echo "selected";} ?> > Promocional </option>
                    </select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Precio" >Precio:</label>
					</div>
					<div class="col-sm-10">
						<input class="form-control" type="number" name="precio" min="0" step="0.01" value="<?= $precio ?>" required>
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" for="Existencias" >Existencias:</label>
					</div>
					<div class="col-sm-10">
                    <input class="form-control" type="number" name="exist" min="0" step="1" value="<?= $exist ?>" required> <br>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" name="Registrar" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</a>
			</form>
            </div>
 
        </div>
    </div>
</div>