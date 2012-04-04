<?php if($data) $row = toArray($data[0]); ?>
<form method="post" action = "/Inventario/addSuma/<?= $row->id_items ?>">
	<input type="hidden" name="id_item" value="<?= $row->id_items ?>">
	<input type="hidden" name="fecha" value="<?= date('Y-m-d') ?>">
	<input type="hidden" name="id_proveedor" value="1">

	<input type="text" name="precio" value="5.00">
	<input type="text" name="cantidad" value="2">
	<input type="submit" value="...">
</form>