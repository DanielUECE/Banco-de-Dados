<?php

	// Esse comando indica para o script que ele terá acesso as variáveis de sessão
	session_start();

	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);

	$sql = " SELECT nome, email FROM alunos WHERE nome = '$usuario' AND senha = '$senha' ";



	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	// Teste de consulta
	if($resultado_id){
		// Retorna os dados em uma estrutura de array
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['nome'])){

			$_SESSION['nome'] = $dados_usuario['nome'];
			$_SESSION['email'] = $dados_usuario['email'];

			header('Location: home.php');


		} else{
			header('Location: index.php?erro=1');
		}
	} else{
		echo 'Erro na execução da consulta !!';
	}




					
					




	

?>