<?php
	session_start();
	if (isset($_SESSION['id_usuario'])) {
		header("Location: inicio.php");
		die;
	}
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Login </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="/web/js/senha_login/senha_login.js"></script>
</head>
<body>
	<h1> Login </h1>
	<form method="POST" autocomplete="off" action="/web/valida_login.php">
	<fieldset>
		<legend> Login (Atalho = Alt + w) </legend>
		<p> Email: <input type="email" name="email" accesskey="w" title="Campo para digitar seu email" size=30 required 
		maxlength="50" > </p>
		<p> Senha:
			<input type="password" id="senha" name="senha" title="Campo para digitar sua senha" size="30" 
			maxlength="32" required="" onclick="mostrarSenha()">
			<i class="fa fa-eye" id="text" aria-hidden="true" title="Ocultar senha"></i>
			<i class="fa fa-eye-slash" id="pass" aria-hidden="true" title="Exibir senha"></i>
		</p>
		<button name="Entrar" title="Botão para entrar no sistema"> Botão entrar </button>
	</fieldset>
	</form>
	<footer id="rodape">
	<p> Sistema web desenvolvido na matéria de <b>Laboratório e Programação Web</b>. </p>
	<p> Desenvolvido por <a href="https://github.com/Iury189" target="_blank"> <b> Iury Fernandes </b> </a> 
	e <a href="https://github.com/renanoliveir13" target="_blank"> <b>Renan Oliveira<b></a>. </p>
	</footer>
</body>
</html>