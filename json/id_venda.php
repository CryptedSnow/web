<?php
	// Arquivo conexao.php
	require_once '../conexao/conexao.php';
	// Variavel $cd_venda que recebe a coluna cd_venda da tabela produto
	$cd_venda = $_GET["cd_venda"];  // Importante ser $_GET para a requisicao funcionar
	// Se a selecao for possivel de realizar
	try {
		// Query que faz a selecao do cd_venda
		$selecao = "SELECT * FROM venda WHERE cd_venda = :cd_venda LIMIT 1";
		// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
		$seleciona_dados = $conexao->prepare($selecao);
		// Vincula um valor a um paramentro
		$seleciona_dados->bindValue(':cd_venda',$cd_venda);
		// Executa a operacao
		$seleciona_dados->execute();
		// Retorna uma matriz contendo todas as linhas do conjunto de resultados
		$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Função que converte um array PHP em dados para JSON 
		echo json_encode($linhas);
	// Se a selecao nao for possível de realizar
	} catch (PDOException $falha_selecao) {
		echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
	} catch (Exception $falha) {
		echo "Erro não característico do PDO".$falha->getMessage();
	}
?>