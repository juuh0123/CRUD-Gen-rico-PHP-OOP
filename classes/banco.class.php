<?php

	abstract class banco{
		//propriedades
		public $servidor = "localhost";
		public $usuario =  "root";
		public $senha = "";
		public $nomebanco = "crud";
		public $conexao = null;		
		public $dataset =null;
		public $linhasafetadas = -1;
	
		//metodos	
		public function __construct(){
			$this->conecta();
		}//construtor
		 
		public function __destruct(){
			if($this->conexao != null):
				mysql_close($this->conexao);
			endif;
		}//destrutor
		
		public function conecta(){
			$this->conexao = mysql_connect($this->servidor,$this->usuario,$this->senha,true) 
			or die($this->trataErro(__FILE__,__FUNCTION__,mysql_errno(),mysql_error(),true));
			mysql_select_db($this->nomebanco) or die($this->trataErro(__FILE__,__FUNCTION__,mysql_errno(),mysql_error(),true));
			mysql_query("SET NAMES 'utf8'");
			mysql_query("SET character_set_connection=utf8");
			mysql_query("SET character_set_client=utf8");
			mysql_query("SET character_set_results=utf8");
			//echo "metedo conecta foi chamado";
		}//fecha conecta
	
		public function inserir($objeto){
			//insert into "nome da tabela" (campo1, campo2) values (valor1, valor2);
			$sql = "INSERT INTO ".$objeto->tabela." (";
			for($i=0;$i<count($objeto->camposValores); $i++):
				$sql .= key($objeto->camposValores);
				if($i<(count($objeto->camposValores)-1)):
					$sql .= ", ";
				else:
					$sql .= ") ";
				endif;	
				next($objeto->camposValores);
			endfor;
			reset($objeto->camposValores);
			$sql .= "values (";
			for($i=0; $i<count($objeto->camposValores); $i++):
				$sql .= is_numeric($objeto->camposValores[key($objeto->camposValores)]) ? 
				$objeto->camposValores[key($objeto->camposValores)] :
				"'".$objeto->camposValores[key($objeto->camposValores)]."'";
				if($i < (count($objeto->camposValores)-1)):
					$sql .= ", ";
				else:
					$sql .= ") ";
				endif;	
				next($objeto->camposValores);
			endfor;		
			
			echo $sql;
			return $this->executaSQL($sql);
		}//inserir
		
		public function executaSQL($sql=null){
			if($sql != null):
				$query = mysql_query($sql) or $this->trataErro(__FILE__, __FUNCTION__);
				$this->linhasafetadas = mysql_affected_rows($this->conexao);
			else:
				$this->trataErro(__FILE__,__FUNCTION__,null, 'comando sql nao informado na rotina',FALSE);
			endif;		
		}//executaSQL
	
		public function trataErro($arquivo=null, $rotina=null, $numero=null, $mensagem=null, $geraExcep=false){
			if($arquivo==null){
				$arquivo = "Nao informado";
			}
			if($rotina==null) $rotina="nao informada";
			if($numero==null) $numero=mysql_errno($this->conexao);
			if($mensagem==null) $mensagem = mysql_error($this->conexao);
			$resultado = 'Ocorreu um erro com os seguintes detalhes:<br />
				<strong>Arquivo:</strong> '.$arquivo.'<br />
				<strong>Rotina:</strong> '.$rotina.'<br />
				<strong>Codigo:</strong> '.$numero.'<br />
				<strong>Mensagem:</strong> '.$mensagem;
				
			if($geraExcep == false): echo($resultado); else: die($resultado); endif;
				
		}//trataErro
		
	}//fim da classe banco

?>
