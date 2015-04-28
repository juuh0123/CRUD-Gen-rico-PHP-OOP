<?php

	require_once("classes/clientes.class.php");
	
	$cliente = new clientes();
	
	//$cliente->delCampo('sobrenome');
	$cliente->setValor('nome','Daniel');
	$cliente->setValor('sobrenome','vieira');
	
	$cliente->inserir($cliente);
	
	echo '<pre>';
	print_r($cliente);
	echo '</pre>';
	echo $cliente->linhasafetadas.' Registro(s) incluido(s) com sucesso';
?>	