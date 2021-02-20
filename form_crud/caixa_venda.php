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
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Fluxo de vendas </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		
		try {
			
			$valor_detalhado = "SELECT DAY(data_venda) AS dia, MONTH(data_venda) AS mes, YEAR(data_venda) AS ano,  
			venda.cd_produto, produto.nome, venda.valor_item, SUM(venda.quantidade) AS qtd_vendida,
			SUM(valor_venda) AS venda_mes FROM venda 
			INNER JOIN produto ON (produto.cd_produto = venda.cd_produto)
			GROUP BY YEAR(data_venda), MONTH(data_venda), venda.cd_produto 
			ORDER BY mes, ano, venda.cd_produto";

			$seleciona_detalhes = $conexao->prepare($valor_detalhado);
			$seleciona_detalhes->execute();
			$linhas_detalhes = $seleciona_detalhes->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $falha_selecao) {
			echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
			die;
		} catch (Exception $falha) {
			echo "Erro não característico do PDO".$falha->getMessage();
			die;
		}
	?>
	<?php
		
		try {
			
			$valor_total = "SELECT YEAR(data_venda) AS ano, SUM(valor_venda) 
			AS venda_total FROM venda GROUP BY YEAR(data_venda) ORDER BY data_venda";

			$seleciona_total = $conexao->prepare($valor_total);
			$seleciona_total->execute();
			$linhas_total = $seleciona_total->fetchAll(PDO::FETCH_ASSOC);

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
					<li><a href="/web/form_crud/form_delete_funcionario.php" title="Excluir funcionário"> Excluir funcionário </a></li>
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
					<li> <a href="/web/form_crud/caixa_venda.php" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/form_crud/caixa_devolucao.php" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
			<li> <a href="/web/form_crud/form_update_senha.php" title="Alterar senha"> Alterar senha </a> </li>
			<li> <a href="/web/logout.php" title="Sair do sistema"> Sair </a> </li> 
		</ul>
	</nav>

	<table border="1">
		<caption title="Movimentação anual"> Movimentação anual </caption>
		<tr> 
			<th title="Ano"> Ano </th> 
			<th title="Valor total de vendas"> Valor total de vendas </th> 
		</tr>
		<?php 
			foreach ($linhas_total as $exibir_colunas){
				echo '<tr>';
				echo '<td title="'.$exibir_colunas['ano'].'">'.$exibir_colunas['ano'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['venda_total'].'">R$'.$exibir_colunas['venda_total'].'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<table border="1">
		<caption title="Movimentação mensal"> Movimentação mensal </caption>
		<tr> 
			<th title="Dia"> Dia </th> 
			<th title="Mês"> Mês </th> 
			<th title="Ano"> Ano </th> 
			<th title="Produto"> Produto </th> 
		    <th title="Valor item"> Valor item </th> 
		    <th title="Quantidade vendida"> Quantidade vendida </th> 
		    <th title="Total"> Total </th> 
		</tr>
		<?php 
			foreach ($linhas_detalhes as $exibir_colunas){
				echo '<tr>';
				echo '<td title="'.$exibir_colunas['dia'].'">'.$exibir_colunas['dia'].'</td>';
				echo '<td title="'.$exibir_colunas['mes'].'">'.$exibir_colunas['mes'].'</td>';
				echo '<td title="'.$exibir_colunas['ano'].'">'.$exibir_colunas['ano'].'</td>';
		 		echo '<td title="'.$exibir_colunas['nome'].'">'.$exibir_colunas['nome'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_item'].'">R$'.$exibir_colunas['valor_item'].'</td>';
		 		echo '<td title="'.$exibir_colunas['qtd_vendida'].' produto(s) vendido(s)">'.$exibir_colunas['qtd_vendida'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['venda_mes'].'">R$'.$exibir_colunas['venda_mes'].'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
</body>
</html>