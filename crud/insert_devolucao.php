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
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> INSERT | DEVOLUÇÃO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Inserir
		if (isset($_POST['Inserir'])) {
			// Especifica a variavel
			$cd_venda = intval($_POST['cd_venda']);
			$cd_produto = intval($_POST['cd_produto']);
			$valor_item = floatval($_POST['valor_item']);
			$quantidade = intval($_POST['quantidade']);
			$motivo_devolucao = strval($_POST['motivo_devolucao']);
			$valor_devolucao = floatval(($valor_item * $quantidade));
			$quantidade_antiga = $calculo_reposicao = $reposicao_produto = 0;

			// Se a quantidade ou valor do item for menor/igual a zero
			if ($quantidade <= 0 || $valor_item <= 0) { 
				echo "A quantidade ou valor do produto não pode ser igual ou menor que zero, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_insert_devolucao.php/#cad_dev" 
				title="Refazer operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Se a atualizacao for possível de realizar
			try {
				// Tabela VENDA
				// Query que busca o a quantidade de um registro da tabela venda
				$procurar_venda = "SELECT cd_produto, quantidade FROM venda WHERE cd_venda = :cd_venda";
				$busca_registro = $conexao->prepare($procurar_venda);
				$busca_registro->bindValue(':cd_venda', $cd_venda);
				$busca_registro->execute();
				$linha = $busca_registro->fetch(PDO::FETCH_ASSOC);
				// Vincula um valor a um parametro das colunas da tabela venda
				$quantidade_antiga = $linha['quantidade'];


				// Tabela VENDA
				if ($quantidade > $quantidade_antiga) {
					// Caso a quantidade devolvida seja maior que a quantidade vendida
					echo "A quantidade devolvida é maior que a quantidade vendida, refaça novamente a operação.";
					echo '<p><a href="../form_crud/form_insert_devolucao.php/#cad_dev" 
					title="Refazer operação"><button>Refazer operação</button></a></p>';
					exit;
				}

				// Havera retirada de produto (caso a nova quantidade seja menor que a antiga)
				$calculo_reposicao = "UPDATE venda SET quantidade = (:quantidade_antiga-:quantidade),
				valor_venda = (valor_item * quantidade) WHERE cd_venda = :cd_venda";
				
				$reposicao_produto = "UPDATE produto SET quantidade = (quantidade+:quantidade) 
				WHERE cd_produto = :cd_produto";

				// Metodo que inicializa a(s) transação(oes)
				$conexao->beginTransaction();
				// Query que faz a insercao	
				$insercao = "INSERT INTO devolucao (cd_venda,cd_produto,valor_item,quantidade,valor_devolucao,motivo_devolucao)
				VALUES (:cd_venda,:cd_produto,:valor_item,:quantidade,:valor_devolucao,:motivo_devolucao)";
				// $atualiza_dados recebe $conexao que prepara a operacao de inserção
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':cd_venda', $cd_venda);
				$insere_dados->bindValue(':cd_produto', $cd_produto);
				$insere_dados->bindValue(':valor_item', $valor_item);
				$insere_dados->bindValue(':quantidade', $quantidade);
				$insere_dados->bindValue(':valor_devolucao', $valor_devolucao);
				$insere_dados->bindValue(':motivo_devolucao', $motivo_devolucao);
				// Executa a operacao
				$insere_dados->execute();
				
				// $quantidade_devolvida prepara a transacao para atualiza o estoque na tabela venda
				$quantidade_devolvida = $conexao->prepare($calculo_reposicao);
				// Vincula um valor a um parametro da tabela produto
				$quantidade_devolvida->bindValue(':cd_venda', $cd_venda);
				$quantidade_devolvida->bindValue(':quantidade', $quantidade);
				$quantidade_devolvida->bindValue(':quantidade_antiga', $quantidade_antiga);
				$quantidade_devolvida->execute();

				$devolver_produto = $conexao->prepare($reposicao_produto);
				$devolver_produto->bindValue(':cd_produto', $linha['cd_produto']);
				$devolver_produto->bindValue(':quantidade', $quantidade);
				$devolver_produto->execute();
				// Confirma a execucao das query's em todas as transacoes  
				$conexao->commit();
				// Retorna para a pagina de formulario de insercao
				header('Location: ../form_crud/form_select_devolucao#nome.php');
				die();
				// Se a atualizacao nao for possivel de realizar
			} catch (PDOException $falha_insercao) {
				echo "A insercão não foi feita".$falha_insercao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_insert_devolucao.php/#cad_dev" 
			title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>