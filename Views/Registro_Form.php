<?php if($data) $row = toArray($data[0]); ?>
<form method="post" action = "/Registro/add/<?= $row->id_proveedor ?>">
	<input type="text" name="nombre" value="<?= $row->nombre ?>">
	<input type="submit" value="...">
</form>