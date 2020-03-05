<?php
require_once 'usuario.php';
$u = new Usuario;

//Verificar se clicou no botão
if(isset($_POST['nome']))
{
	$nome = addslashes($_POST['nome']);
	$cpf = addslashes($_POST['cpf']);
	$endereco = addslashes($_POST['endereco']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	//Verificar se está preenchido
	if (!empty($nome) && !empty($cpf) && !empty($endereco) && !empty($email) &&  !empty($senha))
	{
		$u->conectar("clientes2","localhost","root","");
		if ($u->msgErro == "")//Se está tudo ok
		{
			if($senha == $confirmarSenha)
			{
				if($u->cadastrar($nome, $cpf, $cnpj, $endereco, $email, $senha))
				{
					echo "Cadastrado com sucesso! Acesse para entrar";
				}
				else
				{
					echo "E-mail já cadastrado!";
				}
			}
			else
			{
				echo "Senha e Confirmar Senha não correspondem!";
			}
			
		}
		else
		{
			echo "Erro: ".$u->msgErro;
		}
	}
	else
	{
		echo "Preencha todos os campos!";
	}
}

?>