<ul style="list-style-type: none; font-size:11px;">
	<?php foreach($data as $registroData): $row = toArray($registroData); ?>
		<li>
			<?= "{$row->nombre} " ?> 
			<a href="Editar/<?=$row->id_items ?>">m</a>
			
			<?php 
				if($row->estatus == 0) echo "<a href='OnOff/$row->id_items/1'>on</a>";
				else echo "<a href='OnOff/$row->id_items/0'>off</a>";
			?>
			<a href="Sumar/<?=$row->id_items ?>">+</a>
			<a href="Restar/<?=$row->id_items ?>">-</a>
		</li>
	<?php endforeach ?>
</ul>