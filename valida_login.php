<?php

	// Se nao existir o id da sessao ou se a sessao nao estiver aberta
	if (!session_id() || !isset($_SESSION)) {
		session_start();
	}

	// Se nao existir o botao de Entrar
	if (!isset($_POST['Entrar'])) {
		echo "<script> alert('Ação inválida, realize o login para acessar o sistema.'); location.href='/web/index.php' </script>";
		die;
	}

	// Se os parametros de email ou senha forem vazios
	if (empty($_POST['email']) || empty($_POST['senha'])) {
		echo "<script> alert('Dados inválidos, refaça novamente o login.'); location.href='/web/index.php' </script>";
		die;
	}

	// Importando arquivo conexao.php
	require(__DIR__ . '/conexao/conexao.php');
	// Importando arquivo classe_usuario.php
	require(__DIR__ . '/classe/classe_usuario.php');
	
	// Criando uma instancia da classe Usuario
	$u = new Usuario();
	// Especifica a variavel
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	// Verifica se o metodo e falso
	if ($u->Logar($email, $senha) == false) {
		echo "<script> alert('Dados inválidos, refaça novamente o login.'); location.href='/web/index.php' </script>";
		die;																								
	}																						

	// Sera redirecionado para a pagina inicio.php
	echo "<script> alert('{$_SESSION['nome_usuario']}, você acabou de entrar no sistema.'); location.href='/web/inicio.php' </script>";
	die;
	
?>