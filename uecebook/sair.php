<?php


session_start();

//Destruindo as variáveis de sessão. Eliminando os índices.
unset($_SESSION['nome']);
unset($_SESSION['email']);

header('Location: index.php');



?>