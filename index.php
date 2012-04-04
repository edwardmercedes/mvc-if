<?php
error_reporting(0);

define('V','Views');
define('M','Models');
define('C','Controllers');

function __autoload($class_name) {
    include 'Controllers/'.$class_name . '.php';
}

//TRANSFORMAR UN ARRAY EN OBJETO PARA HACEDER A SU VALOR
function toArray($array){
    foreach ($array as $k => $v) {
		$data -> {$k} = $v;
	}
	return $data;
}
$estado = array('A' => 'Activo','C' => 'Cancela','D' => 'Desabilitado');

$vars = array_keys($_GET);
list($modulo,$metodo,$id,$value) = explode('/', substr($vars[0],1));

$modulo = new $modulo();

if($metodo and $id and $value) $modulo->$metodo($id,$value);
elseif($metodo and $id) $modulo->$metodo($id);
elseif($metodo!='') $modulo->$metodo();
else $modulo->Index();
?>
