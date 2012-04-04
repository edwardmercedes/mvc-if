<?php 
class Sql{
	private $_link;
	private $_db;

	private $_action = '';
	private $_colSelect = array();
	private $_colValue = array();
	private $_colSet = array();
	private $_colFrom = array();
	private $_colWhere = array();
	private $_colOrder = array();
	private $_limit = '';

	public function __construct($action = 'SELECT'){
		$this->_action = $action;
	}

//FUNCIONES DE AGREGAR ARRAY
	public function addSelect($select){
		if(is_array($select)){
			foreach($select as $data){
				$this->_colSelect[] = $data;	
			}
		}
		else{
			$this->_colSelect[] = $select;	
		}
	}
	public function addAction($action){
		$this->_action = $action;
	}
	public function addValue($value){
		if(is_array($value)){
			foreach ($value as $data) {
				$this->_colValue[] = $data;		
			}
		}
		else{
			$this->_colValue[] = $value;
		}
	}
	public function addSet($set){
		if(is_array($set)){
			foreach($set as $data){
				$this->_colSet[] = $data;				
			}
		}
		else{
			$this->_colSet[] = $set;
		}
	}
	public function addFrom($from){
		if(is_array($from)){
			foreach ($from as $data) {
				$this->_colFrom[] = $data;		
			}
		}
		else{
			$this->_colFrom[] = $from;
		}
	}
	public function addWhere($where){
		if(is_array($where)){
			foreach ($where as $w) {
				$this->_colWhere[] = $w;		
			}
		}
		else{
			$this->_colWhere[] = $where;	
		}
	}
	public function addOrder($order){
		if(is_array($order)){
			foreach($order as $data){
				$this->_colOrder[] = $data;	
			}
		}
		else{
			$this->_colOrder[] = $order;
		}
	}
	public function addLimit($limit){
		$this->_limit = $limit;
	}

	public function getAcction(){
		return $this->_action;
	}
// TO STRING
	public function __toString(){
		return ''.self::gerenalQuery();
	}

//EJECUTAR QUERY	
	public function run(){
		$link = mysql_connect('localhost','root','');
		$db = mysql_select_db('if');

		$queryResorce = mysql_query(self::gerenalQuery()) or $this->error = mysql_error();

		if($this->error == ''){
			if($this->_action == 'SELECT'){
				while($row = mysql_fetch_array($queryResorce,MYSQL_ASSOC)){
					$return[] = $row;
				}
			}
			else{
				$return	= true;
			}
		}
		else $return = $this->error;

		return $return;
	}


//FUNCION GENERAL QUERY
	private function gerenalQuery(){
		$select = implode(',',$this->_colSelect);
		$value = implode(',', $this->_colValue);
		$set = implode(',',$this->_colSet);
		$from = implode(',', $this->_colFrom);
		$where = implode(' AND ',$this->_colWhere);
		$order = implode(',',$this->_colOrder);
		$limit = $this->_limit;

		switch ($this->_action) {
			case 'INSERT':
				$sql_str = "INSERT INTO $from ($select) VALUES ($value) ";
			break;
			
			case 'UPDATE':
				$sql_str = "UPDATE $from SET $set WHERE $where ";
			break;

			case 'DELETE':
				$sql_str = "DELETE FROM $from WHERE $where ";
			break;

			default:
				if($select == '') $select = '*';

				$sql_str = "SELECT $select FROM $from ";	

				if(count($this->_colWhere) >= 1) $sql_str .= "  WHERE $where ";
				if(count($this->_colOrder) >= 1) $sql_str .= "  ORDER BY  $order ";	
				if($this->_limit != '') $sql_str .= "  LIMIT  $limit ";	
			break;
		}
		return $sql_str;
	}
}