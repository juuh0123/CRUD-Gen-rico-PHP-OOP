<?php
	require_once("banco.class.php");
	
	abstract class Base extends  banco{
		//propriedades ou atributos
		
		public $tabela = "";
		public $camposValores = array();
		public $campoPk = null;
		public $valorPk = null;
		public $extrasSelect = "";
		
		//funções ou métodos
		public function addCampo($campo=null,$valor=null){
			if($campo!=null): $this->camposValores[$campo] = $valor;
			endif;			
		}//addCampo
		public function delCampo($campo =null){
			if(array_key_exists($campo, $this->camposValores)):
			unset($this->camposValores[$campo]);
			endif;
		}//delCampo
		public function setValor($campo=null, $valor=null){
			if($campo!=null && $valor != null): 
			$this->camposValores[$campo] = $valor;
			endif;
		}//setValor
		public function getValor($campo =null){
			if($campo != null && array_key_exists($campo, $this->camposValores)):
			return $this->camposValores[$campo]; 
			else:
				return false;
			endif;
		}//getValor
	}//fim da classe Base
	
?>