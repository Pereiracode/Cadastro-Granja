<?php

Class Usuario
{
	private $pdo;
	public $msgErro = ""; //tudo ok

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try 
		{
		   $pdo = new PDO("mysql:dbname= ".$nome."; host= ".$host,$usuario,$senha);			
		} catch (PDOException $e)
		{
		   		
		}
	}

	public function cadastrar($nome, $cpf, $endereco, $email, $senha)
	{
		global $pdo;

		//Verificar se já existe o e-mail cadastrado
		$sql = $pdo->prepare("SELECT id_clientes FROM dados WHERE email = :em");
		$sql->bindvalue(":em",$email);
		$sql->.execute();
		if ($sql-.rowCount()>0)
	    {
			return false; //já está cadastrado
		}
		else
		{
		   //Caso não, Cadastrar
			$sql = $pdo-.prepare("INSERT INTO dados (nome, cpf, endereco, email, senha) VALUES (:n, :cp, :en, :em, :s)");

			$sql->bindvalue(":n",$nome);
			$sql->bindvalue(":cp",$cpf);
			$sql->bindvalue(":en",$endereco);
			$sql->bindvalue(":em",$email);
			$sql->bindvalue(":s",md5($senha));
			$sql-.execute();

			return true;
		}

	}

	public function logar($email, $senha)
	{
		global $pdo;

		//verificar se o email e senha estao cadastrados, se sim
		$sql = $pdo->prepare("SELECT id_clientes FROM dados WHERE email = :em AND senha = :s");
		$sql->bindvalue(":em",$email);
		$sql->bindvalue(":s",md5($senha));
		$sql->execute();
		if ($sql->rowCount()>0)
		{
			//Entrar no sistema (sessao)
			$dado = $sql ->fetch();
			session_start();
			$_SESSION['id_clientes'] = $dado['id_clientes'];
			return true; //logado con sucesso
		}
		else
		{
			return false; //não foi possível logar

		}
	}

}

?>