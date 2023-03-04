<!-- Modal de Borrar un Producto -->
<div class="modal fade" id="borrar_<?php echo $productoActual->codigo; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Eliminar Producto</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Esta seguro que deseas borrar el Modal?</p>
				<h2 class="text-center"><?=$productoActual->nombre ?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="Proceso.php?proceso=borrar&codigo=<?=$productoActual->codigo?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
            </div>
 
        </div>
    </div>
</div>