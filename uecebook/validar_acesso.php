<?php

	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);

	$sql = " SELECT * FROM alunos WHERE nome = '$usuario' AND senha = '$senha' ";



	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	// Teste de consulta
	if($resultado_id){
		// Retorna os dados em uma estrutura de array
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['nome'])){
			echo 'usuario existe !!';
		} else{
			header('Location: index.php?erro=1');
		}
	} else{
		echo 'Erro na execução da consulta !!';
	}




					
					




	

?>