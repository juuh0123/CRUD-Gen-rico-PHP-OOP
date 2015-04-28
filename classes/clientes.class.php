<?php
	require_once("base.class.php");
	class Clientes extends base{
		
		public function __construct($campos=array()){
			parent::__construct();
			$this->tabela = "clientes";
			if(sizeof($campos)<=0):
				$this->camposValores = array(
				"nome"=> NULL,
				"sobrenome"=>NULL,
				);
			else:
				$this->camposValores = $campos;
			endif;
			$this->campoPk = "id";	
		}//construct
	}//fim da classe Clientes
?>