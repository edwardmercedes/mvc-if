<?php 
include M.'/RegistroFormModel.php';

class Registro{

	public function Index(){
		$data = RegistroM::Index();

		include V."/Registro_Index.php";
	}

	public function Form(){
		include V."/Registro_Form.php";
	}

	public function Editar($id){
		$data = RegistroM::Index("id_proveedor = '$id'");
		include V."/Registro_Form.php";
	}

	public function add($id){
		RegistroM::add($_POST,$id);
		header('Location: /Registro/');
	}
}
