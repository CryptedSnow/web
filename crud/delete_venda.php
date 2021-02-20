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
	<title> DELETE | VENDA </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botão de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variável
			$cd_venda = $_POST['cd_venda'];
			$atualiza_quantidade = 0;

			// Query que verifica se existe o registro de venda em devolucao
			$procurar_key = "SELECT COUNT(cd_venda) AS countDevolucao FROM devolucao WHERE cd_venda = :cd_venda";
			$busca_key = $conexao->prepare($procurar_key);
			$busca_key->bindValue(':cd_venda',$cd_venda);
			$busca_key->execute();
			$linha2 = $busca_key->fetch(PDO::FETCH_ASSOC);
			$countDevolucao = $linha2['countDevolucao'];

			// Se o registro de venda existir na tabela devolucao 
			if ($countDevolucao != 0) {
				$pluralSingular = $countDevolucao == 1 ? "uma devolução" : "$countDevolucao devoluções";
				echo "Você não pode apagar esse registro, pois está sendo usado em $pluralSingular.";
				echo '<p><a href="../form_crud/form_delete_venda.php" title="Refazer operação">
				<button>Refazer operação</button></a></p>';
				exit;
			}

			// Se a remocao for possiel de realizar
			try {
				// Metodo que inicializa a(s) transacao(oes)
				$conexao->beginTransaction();
            	// Busca registro da tabela venda
				$procurar_produto = "SELECT cd_produto, quantidade FROM venda WHERE cd_venda = :cd_venda LIMIT 1";
            	// $busca_registro recebe $procurar_produto que prepara a selecao do registro
				$busca_registro = $conexao->prepare($procurar_produto);
            	// Vincula um valor a um parametro
				$busca_registro->bindValue(':cd_venda',$cd_venda);
            	// Executa a operação
				$busca_registro->execute();
				$linha = $busca_registro->fetch(PDO::FETCH_ASSOC);
            	// Variaveis a serem usadas no update da tabela produto
				$quantidade = $linha['quantidade']; 
				$cd_produto = $linha['cd_produto'];

				// TABELA VENDA
			    // Query que faz a remocao
				$remove = "DELETE FROM venda WHERE cd_venda = :cd_venda";
			    // $remocao recebe $conexao que prepare a operacao de exclusao
				$remocao = $conexao->prepare($remove);
			    // Vincula um valor a um parametro
				$remocao->bindValue(':cd_venda',$cd_venda);
			    // Executa a operacao
				$remocao->execute();

			    // TABELA PRODUTO
			    // Query que faz a atualizacao da quantidade de estoque da tabela produto
				$atualiza_quantidade = "UPDATE produto SET quantidade = quantidade + :quantidade WHERE cd_produto = :cd_produto";
        		// $quantidade_produto recebe $conexao que prepara a transacao para atualiza o estoque na tabela produto
				$quantidade_produto = $conexao->prepare($atualiza_quantidade);
				$quantidade_produto->bindValue(':quantidade',$quantidade);
				$quantidade_produto->bindValue(':cd_produto',$cd_produto);
        		// Executa a operacao
				$quantidade_produto->execute();
        		// Confirma a execucao das query's em todas as transacoes 
				$conexao->commit();
        		// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_venda.php');
			// Se a remocao nao for possivel de realizar
			} catch (PDOException $falha_remocao) {
				echo "A remoção não foi feita".$falha_remocao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_delete_venda.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>