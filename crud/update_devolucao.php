<?php
	// Arquivo conexao.php
	require_once '../conexao/conexao.php'; 
	// Arquivo classe_usuario.php
	require_once '../classe/classe_usuario.php';
	// Inicio da sessao
	session_start();
	// Se existir $_SESSION['id_usuario'] e $_SESSION['nome_usuario']
	if(isset($_SESSION['id_usuario']) && isset($_SESSION['nome_usuario'])){
		// Mensagem
		echo "Olá " . $_SESSION['nome_usuario'] . "!";
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
	<title> UPDATE | DEVOLUÇÃO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Atualizar
		if (isset($_POST['Atualizar'])) {
			// Especifica a variavel
			$cd_devolucao = $_POST['cd_devolucao'];
			$cd_venda = $_POST['cd_venda'];
			$cd_produto = $_POST['cd_produto'];
			$valor_item = $_POST['valor_item'];
			$quantidade = $_POST['quantidade'];
			$motivo_devolucao = $_POST['motivo_devolucao'];
			$valor_devolucao = ($valor_item * $quantidade);
			$calculo_reposicao = $quantidade_atual = $quantidade_inicial = $quantidade_antiga_devolucao = 0;

			// Se a quantidade ou valor do item for menor/igual a zero
			if ($quantidade <= 0 || $valor_item <= 0) { 
				echo "A quantidade ou valor do produto não pode ser igual ou menor que zero, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_update_devolucao.php" 
				title="Refazer a operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Se a atualizacao for possivel de realizar
			try {
				// Tabela VENDA
				// Query que busca a quantidade de um registro da tabela venda
				$procurar_produto = "SELECT quantidade FROM venda WHERE cd_venda = :cd_venda";
				// busca_registro recebe $conexao que prepare a operacao de selecao
				$busca_registro = $conexao->prepare($procurar_produto);
				// Vincula um valor a um parametro
				$busca_registro->bindValue(':cd_venda',$cd_venda);
				// Executa a operacao
				$busca_registro->execute();
				// Retorna uma matriz contendo todas as linhas do conjunto de resultados
				$linha = $busca_registro->fetch(PDO::FETCH_ASSOC);
				// $quantidade_atual armazena a quantidade
				$quantidade_atual = $linha['quantidade'];

				// Tabela DEVOLUÇAO
				// Query que busca a quantidade de um registro da tabela devolucao
				$procurar_produto_devolucao = "SELECT quantidade FROM devolucao WHERE cd_devolucao = :cd_devolucao";
				// busca_registro_devolucao recebe $conexao que prepare a operacao de selecao
				$busca_registro_devolucao = $conexao->prepare($procurar_produto_devolucao);
				// Vincula um valor a um parametro
				$busca_registro_devolucao->bindValue(':cd_devolucao',$cd_devolucao);
				// Executa a operacao
				$busca_registro_devolucao->execute();
				// Retorna uma matriz contendo todas as linhas do conjunto de resultados
				$linha_devolucao = $busca_registro_devolucao->fetch(PDO::FETCH_ASSOC);
				// $quantidade_antiga_devolucao armazena a quantidade
				$quantidade_antiga_devolucao = $linha_devolucao['quantidade'];
				// quantidade de vendas inicial antes das devolucoes
				$quantidade_inicial = $quantidade_atual + $quantidade_antiga_devolucao;

				// Metodo que inicializa a(s) transacao(oes)
				$conexao->beginTransaction();
				// Query que faz a atualizacao
				$atualizacao = "UPDATE devolucao SET cd_venda = :cd_venda,
				cd_produto = :cd_produto, valor_item = :valor_item, quantidade = :quantidade,
				valor_devolucao = :valor_devolucao, motivo_devolucao = :motivo_devolucao 
				WHERE cd_devolucao = :cd_devolucao";
				// $atualiza_dados recebe $conexao que prepare a operacao de atualizacao
				$atualiza_dados = $conexao->prepare($atualizacao);
				// Vincula um valor a um parametro
				$atualiza_dados->bindValue(':cd_devolucao', $cd_devolucao);
				$atualiza_dados->bindValue(':cd_venda', $cd_venda);
				$atualiza_dados->bindValue(':cd_produto', $cd_produto);
				$atualiza_dados->bindValue(':valor_item', $valor_item);
				$atualiza_dados->bindValue(':quantidade', $quantidade);
				$atualiza_dados->bindValue(':valor_devolucao', $valor_devolucao);
				$atualiza_dados->bindValue(':motivo_devolucao', $motivo_devolucao);
				// Executa a operacao
				$atualiza_dados->execute();

				// Tabela VENDA
				// Caso a quantidade devolvida seja menor que a quantidade antiga
				if ($quantidade <= $quantidade_inicial) {
					// quantidade atualizada
					$quantidade = $quantidade_inicial - $quantidade;
					// Atualização da quantidade 
					$calculo_reposicao = "UPDATE venda SET quantidade = :quantidade,
					valor_venda = (valor_item * quantidade) WHERE cd_venda = :cd_venda";
				// Caso a quantidade devolvida seja maior que a quantidade antiga
				} else {
					echo "A quantidade devolvida é maior que a quantidade vendida, refaça novamente a operação.";
					echo '<p><a href="../form_crud/form_update_devolucao.php" title="Refazer a operação">
					<button>Refazer operação</button></a></p>';
					exit;
				}
				// $quantidade_devolvida prepara a transacao para atualiza o estoque na tabela venda
				$quantidade_devolvida = $conexao->prepare($calculo_reposicao);
				// Vincula um valor a um parametro da tabela produto
				$quantidade_devolvida->bindValue(':cd_venda', $cd_venda);
				$quantidade_devolvida->bindValue(':quantidade', $quantidade);
				// Executa a operacao
				$quantidade_devolvida->execute();
	    		// Confirma a execucao das query's em todas as transacoes  
	    		$conexao->commit();
	    		// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_devolucao.php');
			// Se a atualizacao nao for possivel de realizar
			} catch (PDOException $falha_atualizacao) {
				echo "A atualização não foi feita" . $falha_atualizacao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_update_devolucao.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>