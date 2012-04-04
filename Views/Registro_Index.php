<ul style="list-style-type: none; font-size:11px;">
	<?php foreach($data as $registroData): $row = toArray($registroData) ?>
		<li>
			<?= "{$row->nombre} " ?> 
			<a href="Editar/<?=$row->id_proveedor ?>">m</a>
		</li>
	<?php endforeach ?>
</ul>