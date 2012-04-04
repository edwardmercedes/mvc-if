<?php if($data) $row = toArray($data[0]); ?>
<form method="post" action = "/Inventario/EditarSave/<?= $row->id_items ?>">

	<input type="text" name="id_categoria" value="<?= $row->id_categoria ?>">
	<input type="text" name="nombre" value="<?= $row->nombre ?>">
	<input type="text" name="precio" value="<?= $row->precio ?>">
	<input type="text" name="existen" value="<?= $row->existen ?>">
		
	<input type="submit" value="...">
</form>