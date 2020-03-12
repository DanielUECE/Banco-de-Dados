<?php

	require_once('db.class.php');


	$usuario 	     = 	$_POST['nome'];
	$data_nascimento =	$_POST['data_nascimento'];
	$id_curso 		 = 	$_POST['curso'];
	$matricula 		 = 	$_POST['matricula'];
	$email 		     = 	$_POST['email'];
	$senha 			 =	md5($_POST['senha']);
						//recebe um parâmetro e retorna um hash de 32 caracteres baseado no algoritmo md5



	$objDb = new db();
	$link = $objDb->conecta_mysql(); 

	$nome_existe = false;
	$email_existe = false;

	//echo $curso;

	//verificar se o usuario ja existe 
	$sql = " select * from alunos where nome = '$usuario' ";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_alunos = mysqli_fetch_array($resultado_id);

		if(isset($dados_alunos['nome'])){
			$nome_existe = true;
		}
	}else{
		echo 'Erro ao tentar achar o registro de usuário';
	}


	//verificar se o email ja existe
	$sql = " select * from alunos where email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_alunos = mysqli_fetch_array($resultado_id);

		if(isset($dados_alunos['email'])){
			$email_existe = true;
		}
	}else{
		echo 'Erro ao tentar achar o registro de email';
	}


	if($nome_existe || $email_existe){

		$retorno_get = '';

		if($nome_existe){
			$retorno_get.="erro_usuario=1&";
		}

		if($email_existe){
 			$retorno_get.="erro_email=1&";
 		}

 		// ? -> delimitador
		header('Location: inscrevase.php?'.$retorno_get);

		//Caso já exista dados cadastrados no banco, o die() interrompe a leitura do script e não insere os novos dados no banco
		die();
	}

	/*$sql = " select * from cursos";
	$result_cursos = mysqli_query($link, $sql);
	$row_cursos = mysqli_fetch_assoc($result_cursos);
	echo $row_cursos['nome'];*/




	// Chave Estrangeira
	/*$sql = " select id from cursos where nome='$curso' "; //where nome = '$curso' ";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
	echo $row['id'];*/
	
	
	
	
	
	
	// Escrevendo as querys
	$sql = " insert into alunos(nome, data_nascimento, id_curso, matricula, email, senha) values('$usuario', '$data_nascimento', '$id_curso', '$matricula', '$email', '$senha') ";

	//executar a query
	if(mysqli_query($link, $sql)){
		echo 'Aluno cadastrado com sucesso !!!';
	}else{
		echo 'Erro ao cadastrar o aluno !!!';
	}



?>