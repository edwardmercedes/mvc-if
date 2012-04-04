<?php 
include M.'/Sql.php';

abstract class RegistroM{

	public function add($data,$id =''){

		$Sql = new Sql('INSERT');
		if($id != '') {
			$Sql->addAction('UPDATE');
			$Sql->addWhere("id_proveedor = $id ");
		}	
		$Sql->addFrom('proveedor');
	
		foreach($data as $k => $v){
			if($id != ''){
				$Sql->addSet(" $k = '$v' ");
			}
			else{
				$Sql->addSelect($k);
				$Sql->addValue("'$v'");
			}
		}
		$Sql->run();
	}

	public function Index($where = ''){
		$Sql = new Sql();
		$Sql->addFrom('proveedor');

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
}
?>