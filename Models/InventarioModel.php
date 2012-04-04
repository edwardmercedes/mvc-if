<?php 
include M.'/Sql.php';

abstract class InventarioM{

	public function Index($where = ''){
		$Sql = new Sql();
		$Sql->addSelect('I.*,C.nombre as categoria');
		$Sql->addFrom(array('inventario I' , 'categoria C'));
		$Sql->addWhere("I.id_categoria = C.id_categoria");

		if(is_array($where)){
			foreach($where as $w){
				$Sql->addWhere($w);
			}
		}
		elseif($where != ''){
			$Sql->addWhere($where);
		}
		return $Sql->run();
	}	

	public function update($id,$set){
		$Sql = new Sql('UPDATE');
		$Sql->addSet($set);
		$Sql->addFrom('inventario');
		$Sql->addWhere("id_items = $id ");
		return $Sql->run();
	}

	public function getExistencia($id){
		$Sql = new Sql();
		$Sql->addSelect('existen');
		$Sql->addFrom('inventario');
		$Sql->addWhere("id_items = $id ");
		return $Sql->run();
	}
	public function updateExistencia($where,$set,$form){
		$Sql = new Sql('UPDATE');
		$Sql->addSet($set);
		$Sql->addFrom($form);
		$Sql->addWhere($where);
		return $Sql->run();
	}

	public function addSuma($data,$form){
		$Sql = new Sql('INSERT');
		$Sql->addFrom($form);
		foreach($data as $k => $v){
			$Sql->addSelect($k);
			$Sql->addValue("'$v'");
		}
		return $Sql->run();
	}

}
?>