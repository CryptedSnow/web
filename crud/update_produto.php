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
	<title> UPDATE | PRODUTO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Atualizar
		if(isset($_POST['Atualizar'])){
			// Especifica a variavel
			$cd_produto = intval($_POST['cd_produto']);
			$nome = strval($_POST['nome'];)
			$marca = strval($_POST['marca']);
			$codigo_barra = strval($_POST['codigo_barra']);
			$cor = strval($_POST['cor']);
			$tamanho = strval($_POST['tamanho']);
			$genero = strval($_POST['genero']);
			$quantidade = intval($_POST['quantidade']);
			$valor_compra = floatval($_POST['valor_compra']);
			$porcentagem_revenda = intval($_POST['porcentagem_revenda']);
			$valor_revenda = floatval(($valor_compra + ($valor_compra * ($porcentagem_revenda / 100))));

			// Se a quantidade ou valor do item for menor/igual a zero
			if ($quantidade <= 0 || $valor_compra <= 0) { 
				echo "A quantidade ou valor de compra do produto não pode ser igual ou menor que zero, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_update_produto.php" 
				title="Refazer a operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Se a atualizacao for possivel de realizar
			try {
				// Query que faz a atualizacao
				$atualizacao = "UPDATE produto SET nome = :nome, marca = :marca, codigo_barra = :codigo_barra, 
				cor = :cor, tamanho = :tamanho, genero = :genero, quantidade = :quantidade, 
				valor_compra = :valor_compra, porcentagem_revenda = :porcentagem_revenda, 
				valor_revenda = :valor_revenda WHERE cd_produto = :cd_produto";
				// $atualiza_dados recebe $conexao que prepare a operacao de atualizacao
				$atualiza_dados = $conexao->prepare($atualizacao);
				// Vincula um valor a um parametro
				$atualiza_dados->bindValue(':cd_produto', $cd_produto);
				$atualiza_dados->bindValue(':nome', $nome);
			    $atualiza_dados->bindValue(':marca', $marca);
			    $atualiza_dados->bindValue(':codigo_barra', $codigo_barra);
			    $atualiza_dados->bindValue(':cor', $cor);
			    $atualiza_dados->bindValue(':tamanho', $tamanho);
			    $atualiza_dados->bindValue(':genero', $genero);
			    $atualiza_dados->bindValue(':quantidade', $quantidade);
			    $atualiza_dados->bindValue(':valor_compra', $valor_compra);
			    $atualiza_dados->bindValue(':porcentagem_revenda', $porcentagem_revenda);
			    $atualiza_dados->bindValue(':valor_revenda', $valor_revenda);
			    // Executa a operacao
			    $atualiza_dados->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_produto.php');
			// Caso a atualizacao for possivel de realizar
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
			echo '<p><a href="../form_crud/form_update_produto.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>