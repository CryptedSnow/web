<?php

	// Arquivo conexao.php
	require_once '../conexao/conexao.php';

	// Query que armazena INNER JOIN
	$registros_compra = "SELECT compra_fornecedor.cd_compra_fornecedor, 
	fornecedor.nome AS fornecedor_nome, produto.nome AS produto_nome, 
	produto.marca, produto.codigo_barra, produto.cor, produto.tamanho, 
	produto.genero, produto.quantidade, produto.valor_compra,
	compra_fornecedor.data_compra FROM compra_fornecedor
	INNER JOIN fornecedor ON (fornecedor.cd_fornecedor = compra_fornecedor.cd_fornecedor)
	INNER JOIN produto ON (produto.cd_produto = compra_fornecedor.cd_produto)";

	// Se a selecao for possivel de realizar
	try {
		// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
		$seleciona_dados = $conexao->prepare($registros_compra);
		// Executa a operacao
		$seleciona_dados->execute();
		// Retorna uma matriz contendo todas as linhas do conjunto de resultados
		$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Se a selecao nao for possivel de realizar
	} catch (PDOException $falha_selecao) {
		echo "O relatório de itens compra não pode ser gerado".$falha_selecao->getMessage();
		die;
	} catch (Exception $falha) {
		echo "Erro não característico do PDO".$falha->getMessage();
		die;
	}

	$arqExcel = "<meta charset='UTF-8'>";

	$arqExcel .=
		"<table border='1'>
				<caption> Relatório de compra</caption>
				<thead>
					<tr> 
						<th> ID </th> 
						<th> Fornecedor </th> 
						<th> Produto </th> 
						<th> Marca </th> 
						<th> Código de barra </th> 
						<th> Cor </th> 
						<th> Tamanho </th> 
						<th> Gênero </th> 
						<th> Quantidade </th> 
						<th> Valor da compra </th> 
						<th> Data da compra </th> 
					</tr>
				</thead>
					<tbody>";
	foreach ($linhas as $exibir_registros) {
		$arqExcel .= "
							<tr>
					 			<td align='center'>{$exibir_registros['cd_compra_fornecedor']}</td>
					 			<td align='center'>{$exibir_registros['fornecedor_nome']}</td>
					 			<td align='center'>{$exibir_registros['produto_nome']}</td>
					 			<td align='center'>{$exibir_registros['marca']}</td>
					 			<td align='center'>{$exibir_registros['codigo_barra']}</td>
					 			<td align='center'>{$exibir_registros['cor']}</td>
					 			<td align='center'>{$exibir_registros['tamanho']}</td>
					 			<td align='center'>{$exibir_registros['genero']}</td>
					 			<td align='center'>{$exibir_registros['quantidade']}</td>
					 			<td align='center'>R$ {$exibir_registros['valor_compra']}</td>
					 			<td align='center'>" . date('d/m/Y H:i:s', strtotime($exibir_registros['data_compra'])) . "</td>
					 		</tr>";
	}
	$arqExcel .= " 
					</tbody>
		</table>";
	header("Content-Type: application/x-msexcel");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header('Content-Disposition: attachment; filename="relatorio_compra.xls"');
	echo $arqExcel;
?>