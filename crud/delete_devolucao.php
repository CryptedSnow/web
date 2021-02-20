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
	<title> DELETE | DEVOLUÇÃO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variavel
			$cd_devolucao = $_POST['cd_devolucao'];
			$atualiza_quantidade = 0;
			
			// Se a remocao for possivel de realizar
			try {

				// Metodo que inicializa a(s) transacao(oes)
				$conexao->beginTransaction();
            	// Busca registro da tabela venda
            	$procurar_produto = "SELECT cd_venda, cd_produto, quantidade FROM devolucao WHERE cd_devolucao = :cd_devolucao";
            	// $busca_registro recebe $procurar_produto que prepara a selecao do registro
            	$busca_registro = $conexao->prepare($procurar_produto);
            	// Vincula um valor a um parametro
            	$busca_registro->bindValue(':cd_devolucao',$cd_devolucao);
            	// Executa a operacao
            	$busca_registro->execute();
            	// Variavel que recebe a coluna quantidade do registro
            	$coluna = $busca_registro->fetch(PDO::FETCH_ASSOC);
            	// Variaveis a serem usadas no update da tabela venda
            	$quantidade = $coluna['quantidade']; 
            	$cd_venda = $coluna['cd_venda'];
            	$cd_produto = $coluna['cd_produto'];

            	// TABELA DEVOLUCAO
			    // Query que faz a remocao
			    $remove = "DELETE FROM devolucao WHERE cd_devolucao = :cd_devolucao";
			    // $remocao recebe $conexao que prepare a operacao de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Recebendo referencias e valores como argumento
			    $remocao->bindValue(':cd_devolucao',$cd_devolucao);
			    // Executa a operacao
			    $remocao->execute();

			    // TABELA VENDA
			    // Query que faz a atualizacao da quantidade de estoque da tabela venda
        		$atualiza_quantidade = "UPDATE produto SET quantidade = (quantidade + :quantidade) WHERE cd_produto = :cd_produto";
        		// $quantidade_produto recebe $conexao que prepara a transacao para atualiza o estoque na tabela venda
        		$quantidade_itens_venda = $conexao->prepare($atualiza_quantidade);
        		$quantidade_itens_venda->bindValue(':quantidade',$quantidade);
				$quantidade_itens_venda->bindValue(':cd_produto',$cd_produto);
        		// Executa a operacao
        		$quantidade_itens_venda->execute();
        		// Confirma a execução das query's em todas as transacoes 
        		$conexao->commit();
        		// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_devolucao.php');
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
			echo '<p><a href="../form_crud/form_delete_devolucao.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>