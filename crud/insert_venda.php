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
	<title> INSERT | VENDA </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php  
		// Se existir o botao de Inserir
		if (isset($_POST['Inserir'])) {
			// Especifica a variavel
			$cd_produto = intval($_POST['cd_produto']);
			$cd_funcionario = intval($_POST['cd_funcionario']);
			$cd_cliente = intval($_POST['cd_cliente']);
			$valor_item = floatval($_POST['valor_item']);
			$quantidade = intval($_POST['quantidade']);
			$valor_venda = floatval(($valor_item * $quantidade));
			$quantidade_antiga = $atualiza_quantidade = 0;

			// Se a quantidade ou valor do item for menor/igual a zero
			if ($quantidade <= 0 || $valor_item <= 0) {
				echo "A quantidade ou valor do produto não pode ser igual ou menor que zero, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_insert_venda.php/#cad_ven" 
				title="Refazer operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Se a insercao for possível de realizar
			try {

				// Tabela PRODUTO
				// Query que busca a quantidade de um registro da tabela produto
				$procurar_produto = "SELECT quantidade FROM produto WHERE cd_produto = :cd_produto LIMIT 1";
				$busca_registro = $conexao->prepare($procurar_produto);
				$busca_registro->bindValue(':cd_produto', $cd_produto);
				$busca_registro->execute();
				$linha = $busca_registro->fetch(PDO::FETCH_ASSOC);
				// Vincula um valor a um parametro das colunas da tabela venda
				$quantidade_antiga = $linha['quantidade'];

				// Método que inicializa a(s) transacao(oes)
				$conexao->beginTransaction();
				// Query que faz a insercao	
				$insercao = "INSERT INTO venda (cd_produto,cd_funcionario,cd_cliente,valor_item,quantidade,valor_venda) 
				VALUES (:cd_produto,:cd_funcionario,:cd_cliente,:valor_item,:quantidade,:valor_venda)";
				// $atualiza_dados recebe $conexao que prepare a operacao de insercao
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':cd_produto', $cd_produto);
				$insere_dados->bindValue(':cd_funcionario', $cd_funcionario);
				$insere_dados->bindValue(':cd_cliente', $cd_cliente);
				$insere_dados->bindValue(':valor_item', $valor_item);
				$insere_dados->bindValue(':quantidade', $quantidade);
				$insere_dados->bindValue(':valor_venda', $valor_venda);
				// Executa a operacao
				$insere_dados->execute();
				
				// Query que atualiza a coluna quantidade da tabela produto
    			$atualiza_quantidade = "UPDATE produto SET quantidade = quantidade - :quantidade WHERE cd_produto = :cd_produto";
    			// $quantidade_produto recebe $conexao que prepara a transação para atualiza o estoque na tabela produto
    			$quantidade_produto = $conexao->prepare($atualiza_quantidade);
    			// Vincula um valor a um parametro da tabela produto
    			$quantidade_produto->bindValue(':cd_produto', $cd_produto);
    			$quantidade_produto->bindValue(':quantidade', $quantidade);
    			// Executa a operacao
    			$quantidade_produto->execute();

    			// Tabela PRODUTO
				if ($quantidade < $quantidade_antiga) {
					// Havera retirada de produto (caso a nova quantidade seja menor que a antiga)
					$calculo_reposicao = "UPDATE produto SET quantidade = ('$quantidade_antiga'-:quantidade) 
					WHERE cd_produto = :cd_produto";
				// Caso a quantidade vendida seja maior que a quantidade em estoque
				} elseif ($quantidade > $quantidade_antiga) {
					echo "A quantidade de produtos vendidos não pode ultrapassar a quantidade em estoque, refaça novamente a operação.";
					echo '<p><a href="../form_crud/form_insert_venda.php/#cad_ven" 
					title="Refazer operação"><button>Refazer operação</button></a></p>';
					exit;
				}
				// $quantidade_estoque recebe $conexao que prepara a transacao para atualiza o estoque na tabela produto
				$quantidade_estoque = $conexao->prepare($calculo_reposicao);
				// Vincula um valor a um parametro da tabela produto
				$quantidade_estoque->bindValue(':cd_produto', $cd_produto);
				$quantidade_estoque->bindValue(':quantidade', $quantidade);
				// Executa a operacao
				$quantidade_estoque->execute();
    			// Confirma a execucao das query's em todas as transacoes  
    			$conexao->commit();
    			// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_venda/#nome.php');
				die();
			// Se a insercao nao for possivel de realizar
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
			echo '<p><a href="../form_crud/form_insert_venda.php/#cad_ven" 
			title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>