<?php
	// Arquivo conexao.php
	require_once '../conexao/conexao.php';
	// Variavel $cd_compra que recebe a coluna cd_compra_fornecedor da tabela compra_fornecedor
	$cd_compra_fornecedor = $_GET["cd_compra_fornecedor"];  // Importante ser $_GET para a requisicao funcionar
	// Se a selecao for possivel de realizar
	try {
		// Query que faz a selecao do cd_compra_fornecedor
		$selecao = "SELECT * FROM compra_fornecedor WHERE cd_compra_fornecedor = :cd_compra_fornecedor LIMIT 1";
		// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
		$seleciona_dados = $conexao->prepare($selecao);
		// Vincula um valor a um paramentro
		$seleciona_dados->bindValue(':cd_compra_fornecedor', $cd_compra_fornecedor, PDO::PARAM_INT);
		// Executa a operacao
		$seleciona_dados->execute();
		// Retorna uma matriz contendo todas as linhas do conjunto de resultados
		$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Função que converte um array PHP em dados para JSON 
		echo json_encode($linhas);
	// Se a selecao nao for possivel de realizar
	} catch (PDOException $falha_selecao) {
		echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
	} catch (Exception $falha) {
		echo "Erro não característico do PDO".$falha->getMessage();
	}
?>