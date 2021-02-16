<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Listar devoluções </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';  
		// Se a selecao for possivel de realizar
		try {
			// Query que faz a selecao
			$selecao = "SELECT devolucao.cd_devolucao,
			venda.cd_venda, produto.nome, venda.valor_item,
			devolucao.quantidade, devolucao.valor_devolucao,
			venda.quantidade AS qtd_vendida, devolucao.motivo_devolucao, 
			devolucao.data_devolucao FROM devolucao
			INNER JOIN venda ON (venda.cd_venda = devolucao.cd_venda)
			INNER JOIN produto ON (produto.cd_produto = devolucao.cd_produto)";
			// $seleciona_dados recebe $conexao que prepare a operacaoo para selecionar
			$seleciona_dados = $conexao->prepare($selecao);
			// Executa a operacao
			$seleciona_dados->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Se a selecao nao for possivel de realizar
		} catch (PDOException $falha_selecao) {
			echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
			die;
		} catch (Exception $falha) {
			echo "Erro não característico do PDO".$falha->getMessage();
			die;
		}
	?>
	<nav id="menu">
		<ul>
			<li> <a href="/web/inicio.php"> Início </a> </li>
			<li class="submenu"> <a> Cliente </a>
				<ul>
					<li><a href="/web/form_crud/form_insert_cliente.php" title="Cadastrar cliente"> Cadastrar cliente </a></li>
					<li><a href="/web/form_crud/form_select_cliente.php" title="Listar clientes"> Listar clientes </a></li> 
					<li><a href="/web/form_crud/form_update_cliente.php" title="Atualizar cliente"> Atualizar cliente </a></li>
					<li><a href="/web/form_crud/form_delete_cliente.php" title="Excluir cliente"> Excluir cliente </a></li>
				</ul>
			</li>
			<li class="submenu"> <a> Funcionário </a>
				<ul>
					<li><a href="/web/form_crud/form_insert_funcionario.php" title="Cadastrar funcionário"> Cadastrar funcionário </a></li>
					<li><a href="/web/form_crud/form_select_funcionario.php" title="Listar funcionários"> Listar funcionários </a></li> 
					<li><a href="/web/form_crud/form_update_funcionario.php" title="Atualizar funcionário"> Atualizar funcionário </a></li>
					<li><a href="/web/form_crud/form_delete_funcionario.php" title="Excluir funcionário"> Excluir funcionario </a></li>
				</ul>
			</li>
			<li class="submenu"> <a> Fornecedor </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_fornecedor.php" title="Cadastrar fornecedor"> Cadastrar fornecedor </a></li>
					<li> <a href="/web/form_crud/form_select_fornecedor.php" title="Listar fornecedores"> Listar fornecedores </a></li> 
					<li> <a href="/web/form_crud/form_update_fornecedor.php" title="Atualizar fornecedor"> Atualizar fornecedor </a></li>
					<li> <a href="/web/form_crud/form_delete_fornecedor.php" title="Excluir fornecedor"> Excluir fornecedor </a></li>
				</ul>
			</li>
			<li class="submenu"> <a> Produto </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_produto.php" title="Cadastrar produto"> Cadastrar produto </a> </li>
					<li> <a href="/web/form_crud/form_select_produto.php" title="Listar produtos"> Listar produtos </a> </li> 
					<li> <a href="/web/form_crud/form_update_produto.php" title="Atualizar produto"> Atualizar produto </a> </li>
					<li> <a href="/web/form_crud/form_delete_produto.php" title="Excluir produto"> Excluir produto </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Compra </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_compra.php" title="Cadastrar compra"> Cadastrar compra </a> </li>
					<li> <a href="/web/form_crud/form_select_compra.php" title="Listar compras"> Listar compras </a> </li> 
					<li> <a href="/web/form_crud/form_update_compra.php" title="Atualizar compra"> Atualizar compra </a> </li>
					<li> <a href="/web/form_crud/form_delete_compra.php" title="Excluir compra"> Excluir compra </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Venda </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_venda.php" title="Cadastrar venda"> Cadastrar venda </a> </li>
					<li> <a href="/web/form_crud/form_select_venda.php" title="Listar vendas"> Listar vendas </a> </li> 
					<li> <a href="/web/form_crud/form_update_venda.php" title="Atualizar venda"> Atualizar venda </a> </li>
					<li> <a href="/web/form_crud/form_delete_venda.php" title="Excluir venda"> Excluir venda </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Devolução </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_devolucao.php" title="Cadastrar devolução"> Cadastrar devolução </a> </li>
					<li> <a href="/web/form_crud/form_select_devolucao.php" title="Listar devoluções"> Listar devoluções </a> </li> 
					<li> <a href="/web/form_crud/form_update_devolucao.php" title="Atualizar devolução"> Atualizar devolução </a> </li>
					<li> <a href="/web/form_crud/form_delete_devolucao.php" title="Excluir devolução"> Excluir devolução </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Fluxo de caixa </a>
				<ul>
					<li> <a href="/web/crud/caixa_venda.php" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/crud/caixa_devolucao.php" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
		</ul>
	</nav>

	<nav>
		<li> <a href="/web/form_crud/form_update_senha.php" title="Alterar senha"> Alterar senha </a> </li>
		<li> <a href="logout.php" title="Sair do sistema"> Sair </a> </li> 
	</nav>
	<p> Procurar produto devolvido: <input id="nome" title="Campo para procurar determinado item devolvido"/> </p>
	<table id="lista" border="1">
		<tr> 
			<th title="ID"> ID </th>
			<th title="ID venda"> ID venda </th>
			<th title="Produto"> Produto </th>
			<th title="Valor item"> Valor item </th>
			<th title="Quantidade devolvida"> Quantidade devolvida </th> 
			<th title="Valor da devolução"> Valor da devolução </th>
		    <th title="Quantidade vendida"> Quantidade vendida </th>
		    <th title="Motivo da devolução"> Motivo da devolução </th>
		    <th title="Data da devolução"> Data da devolução </th>
		    <th title="Ações"> Ações </th>
		</tr>
		<?php 
			// Loop para exibir as linhas
			foreach ($linhas as $exibir_colunas){
				echo '<tr>';
		 		echo '<td title="'.$exibir_colunas['cd_devolucao'].'">'.$exibir_colunas['cd_devolucao'].'</td>';
		 		echo '<td title="'.$exibir_colunas['cd_venda'].'">'.$exibir_colunas['cd_venda'].'</td>';
		 		echo '<td title="'.$exibir_colunas['nome'].'">'.$exibir_colunas['nome'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_item'].'">R$'.$exibir_colunas['valor_item'].'</td>';
		 		echo '<td title="'.$exibir_colunas['quantidade'].' produto(s) devolvido(s)">'.$exibir_colunas['quantidade'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_devolucao'].'">R$'.$exibir_colunas['valor_devolucao'].'</td>';
		 		echo '<td title="'.$exibir_colunas['qtd_vendida'].' produto(s) vendidos(s) em estoque">'.$exibir_colunas['qtd_vendida'].'</td>';
		 		echo '<td title="'.$exibir_colunas['motivo_devolucao'].'">'.$exibir_colunas['motivo_devolucao'].'</td>';
		 		echo '<td title="'.date('d/m/Y H:i:s', strtotime($exibir_colunas['data_devolucao'])).'">'.
		 		date('d/m/Y H:i:s', strtotime($exibir_colunas['data_devolucao'])).'</td>';
		 		echo '<td>'."<a href='../form_crud/form_insert_devolucao.php' title='Cadastrar devolução'>INSERT</a> ".
		 		"<a href='../form_crud/form_select_devolucao.php' title='Listar devoluções'>SELECT</a> ".
		 		"<a href='../form_crud/form_update_devolucao.php' title='Atualizar devolução'>UPDATE</a> ".
		 		"<a href='../form_crud/form_delete_devolucao.php' title='Deletar devolução'>DELETE</a>".'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<script type="text/javascript" src="/WEB/js/devolucao/select_devolucao.js"></script>
	<p><a href='../planilha/planilha_devolucao.php' title="Botão de download do relatório de devoluções" target="_blank"><button>Donwload do relatório de devoluções</button></a></p>
</body>
</html>