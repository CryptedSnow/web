<?php
	// Arquivo conexao.php
	require(dirname(__FILE__) . '/conexao/conexao.php');
	// Arquivo classe_usuario.php
	require(dirname(__FILE__) . '/classe/classe_usuario.php');
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
<html>
<head>
	<meta charset="utf-8">
	<title> Início </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<script type="text/javascript" src="/web/js/atalho/inicio.js"></script>
</head>
<body>
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
	<?php
		// Se a selecao for possível de realizar
		try {
			// Query que faz a selecao
			$selecao = "SELECT COUNT(cd_cliente) AS qtd_cliente, 
			(SELECT COUNT(cd_funcionario) FROM funcionario) AS qtd_funcionario,
			(SELECT COUNT(cd_fornecedor) FROM fornecedor) AS qtd_fornecedor, 
			(SELECT COUNT(cd_compra_fornecedor) FROM compra_fornecedor) AS qtd_compra,
			(SELECT COUNT(cd_produto) FROM produto) AS qtd_produto, 
			(SELECT COUNT(cd_venda) FROM VENDA) AS qtd_venda, 
			(SELECT COUNT(cd_devolucao) FROM devolucao) AS qtd_devolucao FROM cliente";
			// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
			$seleciona_dados = $conexao->prepare($selecao);	
			// Executa a operacao
			$seleciona_dados->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linha = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Se a selecao nao for possivel de realizar
		} catch (PDOException $falha_selecao) {
			echo "A listagem de dados não foi feita".$falha_selecao->getMessage();
			die;
		} catch (Exception $falha) {
			echo "Erro não característico do PDO".$falha->getMessage();
			die;
		}
	?>
	<table border="1">
		<caption title="Painel"> Painel </caption>
		<tr> 
			<th title="Número de clientes"> N° de clientes </th>
			<th title="Número de funcionários"> N° de funcionários </th>
			<th title="Número de fornecedores"> N° de fornecedores </th>
		    <th title="Número de compras"> N° de compras </th>
		    <th title="Número de produtos"> N° de produtos </th>
		    <th title="Número de vendas"> N° de vendas </th>
		    <th title="Número de devoluções"> N° de devoluções </th>
		</tr>
		<?php
			foreach ($linha as $colunas) {
			 	echo '<tr>';
				echo '<td title="'.$colunas['qtd_cliente'].' cliente(s)">'.$colunas['qtd_cliente'].'</td>';
				echo '<td title="'.$colunas['qtd_funcionario'].' funcionário(s)">'.$colunas['qtd_funcionario'].'</td>';
				echo '<td title="'.$colunas['qtd_fornecedor'].' fornecedor(s)">'.$colunas['qtd_fornecedor'].'</td>';
				echo '<td title="'.$colunas['qtd_compra'].' compra(s)">'.$colunas['qtd_compra'].'</td>';
				echo '<td title="'.$colunas['qtd_produto'].' produto(s)">'.$colunas['qtd_produto'].'</td>';
				echo '<td title="'.$colunas['qtd_venda'].' venda(s)">'.$colunas['qtd_venda'].'</td>';
				echo '<td title="'.$colunas['qtd_devolucao'].' devolução(ões)">'.$colunas['qtd_devolucao'].'</td>';
				echo '</tr>'; echo '</p>';
			} 
		?>
	</table>
	<br/>
	<button href="#" onclick='window.scrollTo({top: 0, behavior: "smooth"})' title="Botão voltar ao topo">Botão topo da página</button>
	<footer id="rodape">
	<p> Sistema web desenvolvido na matéria de <b>Laboratório e Programação Web</b>. </p>
	<p> Desenvolvido por <a href="https://github.com/Iury189" target="_blank" title="Perfil do GitHub de Iury Fernandes"> 
	<b> Iury Fernandes </b> </a> e <a href="https://github.com/renanoliveir13" target="_blank" title="Perfil do GitHub de Renan Oliveira"> <b>Renan Oliveira<b></a>. </p>
	</footer>
</body>
</html>