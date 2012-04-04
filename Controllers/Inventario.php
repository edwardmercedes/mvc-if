<?php 
include M.'/InventarioModel.php';

class Inventario{

	public function Index(){
		$data = InventarioM::Index();
		include V."/Inventario_Index.php";
	}

	public function Editar($id){
		$data = InventarioM::Index("id_items = $id");
		include V."/Inventario_Editar.php";
	}
	public function EditarSave($id){
		foreach ($_POST as $k => $v) {
			$set[] = "$k = '$v' ";
		}
		InventarioM::updateExistencia("id_items = $id",$set,'inventario');
		header('Location: /Inventario/');
	}

	public function OnOff($id,$value = '0'){
		$set = "estatus = $value";
		InventarioM::update($id,$set);
		header('Location: /Inventario/');
	}

	public function Sumar($id){
		$data = InventarioM::Index("id_items = $id");
		echo $data ;
		include V."/Inventario_Sumar.php";
	}
	public function addSuma($id){
		$existencia = InventarioM::getExistencia($id);
		$updateExistencia = $existencia[0]['existen'] + $_POST['cantidad'];
		InventarioM::updateExistencia("id_items = $id","existen = $updateExistencia",'inventario');
		InventarioM::addSuma($_POST,'suma');
		header('Location: /Inventario/');		
	}
	public function Restar($id){
		$data = InventarioM::Index("id_items = $id");
		include V."/Inventario_Restar.php";
	}	
	public function addRestar($id){
		$existencia = InventarioM::getExistencia($id);
		$updateExistencia = $existencia[0]['existen'] - $_POST['cantidad'];
		InventarioM::updateExistencia("id_items = $id","existen = $updateExistencia",'inventario');
		InventarioM::addSuma($_POST,'resta');
		header('Location: /Inventario/');		
	}

}
