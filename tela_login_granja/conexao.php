<?php
	//Sample Database Connection Syntax for PHP and MySQL.
	
	//Connect To Database
	
	$nome=$_POST['nome'];
	$cpf=$_POST['cpf'];
	$endereco=$_POST['endereco'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];

	
	
	mysql_connect("localhost", "root", "", "clientes2");
	if(!$conexao)
	{	
	die("Ocorreu um erro ->".mysqli_error();
	}
	# Verifique se o registro existe
	
	$query="INSERT INTO `clientes2`.`dados` (`nome`,`cpf`,`endereco`,`email`,`senha`) VALUES 
	('".$nome."','".$cpf."','".$endereco."','".$email."','".$senha."', default)";
?>