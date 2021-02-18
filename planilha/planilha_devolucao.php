<?php

	// Arquivo conexao.php
	require_once '../conexao/conexao.php';

	// Query que armazena INNER JOIN
	$registros_devolucao = "SELECT devolucao.cd_devolucao,
	venda.cd_venda, produto.nome, produto.marca, produto.codigo_barra, produto.cor,
	produto.tamanho, produto.genero, venda.valor_item, devolucao.quantidade, 
	funcionario.nome AS nome_funcionario, cliente.nome AS nome_cliente, 
	cliente.cpf AS cpf_cliente, devolucao.valor_devolucao, venda.tipo_pagamento, 
	devolucao.motivo_devolucao, devolucao.data_devolucao FROM devolucao
	INNER JOIN venda ON (venda.cd_venda = devolucao.cd_venda)
	INNER JOIN produto ON (produto.cd_produto = devolucao.cd_produto)
	INNER JOIN funcionario ON (funcionario.cd_funcionario = venda.cd_funcionario)
	INNER JOIN cliente ON (cliente.cd_cliente = venda.cd_cliente)";

	// Se a selecao for possivel de realizar
	try {
		// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
		$seleciona_dados = $conexao->prepare($registros_devolucao);
		// Executa a operacao
		$seleciona_dados->execute();
		// Retorna uma matriz contendo todas as linhas do conjunto de resultados
		$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Se a selecao nao for possivel de realizar
	} catch (PDOException $falha_selecao) {
		echo "O relatório de devoluções não pode ser gerado" . $falha_selecao->getMessage();
		die;
	} catch (Exception $falha) {
		echo "Erro não característico do PDO".$falha->getMessage();
		die;
	}

	$arqExcel = "<meta charset='UTF-8'>";

	$arqExcel .=
		"<table border='1'>
				<caption> Relatório de devoluções </caption>
				<thead>
					<tr> 
						<th> ID </th>
						<th> Venda </th> 
						<th> Produto </th> 
						<th> Marca </th> 
						<th> Código de barra </th> 
						<th> Cor </th> 
						<th> Tamanho </th> 
						<th> Gênero </th>
						<th> Valor do produto </th>
						<th> Quantidade </th>
						<th> Valor da devolução </th> 
						<th> Tipo de pagamento </th> 
						<th> Funcionário </th>
						<th> Cliente </th>
						<th> CPF Cliente </th>  
						<th> Motivo da devolução </th> 
						<th> Data da devolucao </th> 
					</tr>
				</thead>
					<tbody>";
	foreach ($linhas as $exibir_registros) {
		$arqExcel .= "
							<tr>
								<td align='center'>{$exibir_registros['cd_devolucao']}</td>
					 			<td align='center'>{$exibir_registros['cd_venda']}</td>
					 			<td align='center'>{$exibir_registros['nome']}</td>
					 			<td align='center'>{$exibir_registros['marca']}</td>
					 			<td align='center'>{$exibir_registros['codigo_barra']}</td>
					 			<td align='center'>{$exibir_registros['cor']}</td>
					 			<td align='center'>{$exibir_registros['tamanho']}</td>
					 			<td align='center'>{$exibir_registros['genero']}</td>
					 			<td align='center'>R$ {$exibir_registros['valor_item']}</td>
					 			<td align='center'>{$exibir_registros['quantidade']}</td>
					 			<td align='center'>R$ {$exibir_registros['valor_devolucao']}</td>
					 			<td align='center'>{$exibir_registros['tipo_pagamento']}</td>
					 			<td align='center'>{$exibir_registros['nome_funcionario']}</td>
					 			<td align='center'>{$exibir_registros['nome_cliente']}</td>
					 			<td align='center'>{$exibir_registros['cpf_cliente']}</td>
					 			<td align='center'>{$exibir_registros['motivo_devolucao']}</td>
					 			<td align='center'>" . date('d/m/Y H:i:s', strtotime($exibir_registros['data_devolucao'])) . "</td>
					 		</tr>";
	}
	$arqExcel .= " 
					</tbody>
		</table>";
	header("Content-Type: application/x-msexcel");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header('Content-Disposition: attachment; filename="relatorio_devolucao.xls"');
	echo $arqExcel;
?>