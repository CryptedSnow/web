<?php
	// Arquivo conexao.php
	require_once '../conexao/conexao.php'; 
	// Arquivo classe_usuario.php
	require_once '../classe/classe_usuario.php';
	// Inicio da sessao
	session_start();
	// Se existir $_SESSION['id_usuario'] e nao for vazio
	if((isset($_SESSION['id_usuario'])) && (!empty($_SESSION['id_usuario']))){
		// Mensagem
		echo "";
	// Se nao
	} else {
		// Retorna para a pagina index.php
		echo "<script> alert('Ação inválida, entre no sistema da maneira correta.'); location.href='/web/index.php' </script>";
		die;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> UPDATE | COMPRA </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Atualizar
		if(isset($_POST['Atualizar'])){
			// Especifica a variavel
			$cd_compra_fornecedor = intval($_POST['cd_compra_fornecedor']);
			$cd_fornecedor = intval($_POST['cd_fornecedor']);
			$cd_produto = intval($_POST['cd_produto']);
			// Se a atualizacao for possivel de realizar
			try {
				// Query que faz a atualizacao
				$atualizacao = "UPDATE compra_fornecedor SET cd_fornecedor = :cd_fornecedor, 
				cd_produto = :cd_produto WHERE cd_compra_fornecedor = :cd_compra_fornecedor";
				// $atualiza_dados recebe $conexao que prepare a operacao de atualizacao
				$atualiza_dados = $conexao->prepare($atualizacao);
				// Vincula um valor a um parametro
				$atualiza_dados->bindValue(':cd_compra_fornecedor', $cd_compra_fornecedor);
				$atualiza_dados->bindValue(':cd_fornecedor', $cd_fornecedor);
				$atualiza_dados->bindValue(':cd_produto', $cd_produto);
				// Executa a operacao
				$atualiza_dados->execute();
				// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_compra.php');
				// Se a atualizacao nao for possivel de realizar
			} catch (PDOException $falha_atualizacao) {
				echo "A atualização não foi feita".$falha_atualizacao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_update_compra.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>