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
		echo "Usuário: " . $_SESSION['nome_usuario'] . "<br/> ";
		echo "Cargo: " . $_SESSION['cargo_usuario'];
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
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Fluxo de devoluções </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		
		try {
			
			$valor_detalhado = "SELECT DAY(data_devolucao) AS dia, MONTH(data_devolucao) AS mes, YEAR(data_devolucao) AS ano, 
			venda.cd_produto, produto.nome, devolucao.valor_item, SUM(devolucao.quantidade) AS qtd_devolvida, 
			SUM(valor_devolucao) AS devolucao_mes FROM devolucao
			INNER JOIN venda ON (venda.cd_venda = devolucao.cd_venda)
			INNER JOIN produto ON (produto.cd_produto = venda.cd_produto) 
			GROUP BY YEAR(data_devolucao), MONTH(data_devolucao), venda.cd_produto
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
			
			$valor_total = "SELECT YEAR(data_devolucao) AS ano, 
			SUM(valor_devolucao) AS devolucao_total FROM devolucao
			GROUP BY YEAR(data_devolucao) ORDER BY data_devolucao";

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
			<li> <a href="/web/inicio.php" title="Início"> Início </a> </li>
			<li class="submenu"> <a> Cliente </a>
				<ul>
					<li><a href="/web/form_crud/form_insert_cliente.php/#cad_cli" title="Cadastrar cliente"> Cadastrar cliente </a></li>
					<li><a href="/web/form_crud/form_select_cliente.php/#nome" title="Listar clientes"> Listar clientes </a></li> 
					<li><a href="/web/form_crud/form_update_cliente.php/#atu_cli" title="Atualizar cliente"> Atualizar cliente </a></li>
					<li><a href="/web/form_crud/form_delete_cliente.php/#exc_cli" title="Excluir cliente"> Excluir cliente </a></li>
				</ul>
			</li>
			<li class="submenu"> <a> Funcionário </a>
				<ul>
					<li><a href="/web/form_crud/form_insert_funcionario.php/#cad_func" title="Cadastrar funcionário"> Cadastrar funcionário </a></li>
					<li><a href="/web/form_crud/form_select_funcionario.php/#nome" title="Listar funcionários"> Listar funcionários </a></li> 
					<li><a href="/web/form_crud/form_update_funcionario.php/#atu_func" title="Atualizar funcionário"> Atualizar funcionário </a></li>
					<li><a href="/web/form_crud/form_delete_funcionario.php/#exc_func" title="Excluir funcionário"> Excluir funcionário </a></li>
				</ul>
			</li>
			<li class="submenu"> <a> Fornecedor </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_fornecedor.php/#cad_forn" title="Cadastrar fornecedor"> Cadastrar fornecedor </a></li>
					<li> <a href="/web/form_crud/form_select_fornecedor.php/#nome" title="Listar fornecedores"> Listar fornecedores </a></li> 
					<li> <a href="/web/form_crud/form_update_fornecedor.php/#atu_forn" title="Atualizar fornecedor"> Atualizar fornecedor </a></li>
					<li> <a href="/web/form_crud/form_delete_fornecedor.php/#exc_forn" title="Excluir fornecedor"> Excluir fornecedor </a></li>
				</ul>
			</li>
			<li class="submenu"> <a> Produto </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_produto.php/#cad_pro" title="Cadastrar produto"> Cadastrar produto </a> </li>
					<li> <a href="/web/form_crud/form_select_produto.php/#nome" title="Listar produtos"> Listar produtos </a> </li> 
					<li> <a href="/web/form_crud/form_update_produto.php/#atu_pro" title="Atualizar produto"> Atualizar produto </a> </li>
					<li> <a href="/web/form_crud/form_delete_produto.php/#exc_pro" title="Excluir produto"> Excluir produto </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Compra </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_compra.php/#cad_com" title="Cadastrar compra"> Cadastrar compra </a> </li>
					<li> <a href="/web/form_crud/form_select_compra.php/#nome" title="Listar compras"> Listar compras </a> </li> 
					<li> <a href="/web/form_crud/form_delete_compra.php/#exc_com" title="Excluir compra"> Excluir compra </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Venda </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_venda.php/#cad_ven" title="Cadastrar venda"> Cadastrar venda </a> </li>
					<li> <a href="/web/form_crud/form_select_venda.php/#nome" title="Listar vendas"> Listar vendas </a> </li> 
					<li> <a href="/web/form_crud/form_update_venda.php/#atu_ven" title="Atualizar venda"> Atualizar venda </a> </li>
					<li> <a href="/web/form_crud/form_delete_venda.php/#exc_ven" title="Excluir venda"> Excluir venda </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Devolução </a>
				<ul>
					<li> <a href="/web/form_crud/form_insert_devolucao.php/#cad_dev" title="Cadastrar devolução"> Cadastrar devolução </a> </li>
					<li> <a href="/web/form_crud/form_select_devolucao.php/#nome" title="Listar devoluções"> Listar devoluções </a> </li> 
					<li> <a href="/web/form_crud/form_delete_devolucao.php/#exc_dev" title="Excluir devolução"> Excluir devolução </a> </li>
				</ul>
			</li>
			<li class="submenu"> <a> Fluxo de caixa </a>
				<ul>
					<li> <a href="/web/form_crud/caixa_venda.php/#fluxo_ven" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/form_crud/caixa_devolucao.php/#fluxo_dev" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
			<li class="submenu"> <a> Configurações </a>
				<ul>
					<li> <a href="/web/form_crud/form_update_senha.php/#alt_senha" title="Alterar senha"> Alterar senha </a> </li>
					<li> <a href="/web/form_crud/form_area_adm.php/#area_adm" title="Área administrador"> Área administrador </a> </li> 
				</ul>
			</li>
			<li> <a href="/web/logout.php" title="Sair do sistema"> Sair </a> </li> 
		</ul>
	</nav>
	<table id="fluxo_dev" border="1">
		<caption title="Movimentação anual"> Movimentação anual </caption>
		<tr> 
			<th title="Ano"> Ano </th> 
			<th title="Valor total de devoluções"> Valor total de devoluções </th> 
		</tr>
		<?php 
			foreach ($linhas_total as $exibir_colunas){
				echo '<tr>';
				echo '<td title="'.$exibir_colunas['ano'].'">'.$exibir_colunas['ano'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['devolucao_total'].'">R$'.$exibir_colunas['devolucao_total'].'</td>';
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
		    <th title="Valor do item"> Valor item </th> 
		    <th title="Quantidade devolvida"> Quantidade devolvida </th> 
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
		 		echo '<td title="'.$exibir_colunas['qtd_devolvida'].' produto(s) devolvido(s)">'.$exibir_colunas['qtd_devolvida'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['devolucao_mes'].'">R$'.$exibir_colunas['devolucao_mes'].'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<br/>
	<button href="#" onclick='window.scrollTo({top: 0, behavior: "smooth"})' title="Botão voltar ao topo">Botão topo da página</button>
	<footer id="rodape">
	<p> Sistema web desenvolvido na matéria de <b>Laboratório e Programação Web</b>. </p>
	<p> Desenvolvido por <a href="https://github.com/Iury189" target="_blank"> <b> Iury Fernandes </b> </a> 
	e <a href="https://github.com/renanoliveir13" target="_blank"> <b>Renan Oliveira<b></a>. </p>
	</footer>
</body>
</html>