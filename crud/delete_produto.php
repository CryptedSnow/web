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
	<title> DELETE | PRODUTO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variavel
			$cd_produto = intval($_POST['cd_produto']);
			// Buscar nome do produto
			$procurar_nome = "SELECT nome FROM produto WHERE cd_produto = :cd_produto";
			$busca_nome = $conexao->prepare($procurar_nome);
			$busca_nome->bindValue(':cd_produto',$cd_produto);
			$busca_nome->execute();
			$linha_nome = $busca_nome->fetch(PDO::FETCH_ASSOC);
			$nome_produto = $linha_nome['nome'];
			// Query que verifica se existe o registro de cliente em devolucao
			$procurar_produto = "SELECT COUNT(cd_produto) AS countProduto FROM compra_fornecedor WHERE cd_produto = :cd_produto";
			$busca_produto = $conexao->prepare($procurar_produto);
			$busca_produto->bindValue(':cd_produto',$cd_produto);
			$busca_produto->execute();
			$linha = $busca_produto->fetch(PDO::FETCH_ASSOC);
			$countProduto = $linha['countProduto'];
			// Query que verifica se existe o registro de cliente em devolucao
			$procurar_produto2 = "SELECT COUNT(cd_produto) AS countProduto2 FROM venda WHERE cd_produto = :cd_produto";
			$busca_produto2 = $conexao->prepare($procurar_produto2);
			$busca_produto2->bindValue(':cd_produto',$cd_produto);
			$busca_produto2->execute();
			$linha2 = $busca_produto2->fetch(PDO::FETCH_ASSOC);
			$countProduto2 = $linha2['countProduto2'];
			// Se o registro de produto existir na tabela compra ou venda 
			if ($countProduto > 0 || $countProduto2 > 0) {
				$pluralSingular = $countProduto == 1 ? "uma compra" : "$countProduto compras";
				$pluralSingular2 = $countProduto2 == 1 ? "uma venda" : "$countProduto2 vendas";
				echo "Você não pode apagar {$nome_produto} sistema, pois está registrado em $pluralSingular e em $pluralSingular2. <br>";
				echo '<p><a href="../form_crud/form_delete_produto.php/#exc_pro" 
				title="Refazer operação"><button>Botão refazer operação</button></a></p>';
				exit;
			}
			// Se a remocao for possivel de realizar
			try {
			    // Query que faz a remocao
			    $remove = "DELETE FROM produto WHERE cd_produto = :cd_produto";
			    // $remocao recebe $conexao que prepare a operacao de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Vincula um valor a um parametro
			    $remocao->bindValue(':cd_produto', $cd_produto);
			    // Executa a operacao
			    $remocao->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_produto.php/#nome');
				die();
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
			echo '<p><a href="../form_crud/form_delete_produto.php/#exc_pro" 
			title="Refazer operação"><button>Botão refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>