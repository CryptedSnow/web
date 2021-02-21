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
	<title> Listar compras </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se a selecao for possivel de realizar
		try {
			// Query que faz a selecao
			$selecao = "SELECT compra_fornecedor.cd_compra_fornecedor, 
			fornecedor.nome AS fornecedor_nome, produto.nome AS produto_nome, 
			produto.marca, produto.codigo_barra, produto.cor, produto.tamanho, 
			produto.genero, produto.quantidade, produto.valor_compra,
			compra_fornecedor.data_compra FROM compra_fornecedor
			INNER JOIN fornecedor ON (fornecedor.cd_fornecedor = compra_fornecedor.cd_fornecedor)
			INNER JOIN produto ON (produto.cd_produto = compra_fornecedor.cd_produto)";
			// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
			$seleciona_dados = $conexao->prepare($selecao);
			// Executa a operacao
			$seleciona_dados->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
		// Se a selecao nao for possível de realizar
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

	<p> Procurar produto do fornecedor: <input id="nome" title="Campo para procurar determinado produto comprado do fornecedor"/> </p>
	<table id="lista" border="1">
		<tr> 
			<th title="ID"> ID </th>
			<th title="Fornecedor"> Fornecedor </th>
			<th title="Produto"> Produto </th>
			<th title="Marca"> Marca </th>
			<th title="Código de barra"> Código de barra </th> 
		    <th title="Cor"> Cor </th>
		    <th title="Tamanho"> Tamanho </th>
		    <th title="Gênero"> Gênero </th>
		    <th title="Quantidade"> Quantidade </th>
		    <th title="Valor de compra"> Valor de compra </th>
		    <th title="Data da compra"> Data da compra </th>
		    <th> Ações </th>
		</tr>
		<?php 
			// Loop para exibir as linhas
			foreach ($linhas as $exibir_colunas){
				echo '<tr>';
		 		echo '<td title="'.$exibir_colunas['cd_compra_fornecedor'].'">'.$exibir_colunas['cd_compra_fornecedor'].'</td>';
		 		echo '<td title="'.$exibir_colunas['fornecedor_nome'].'">'.$exibir_colunas['fornecedor_nome'].'</td>';
		 		echo '<td title="'.$exibir_colunas['produto_nome'].'">'.$exibir_colunas['produto_nome'].'</td>';
		 		echo '<td title="'.$exibir_colunas['marca'].'">'.$exibir_colunas['marca'].'</td>';
		 		echo '<td title="'.$exibir_colunas['codigo_barra'].'">'.$exibir_colunas['codigo_barra'].'</td>';
		 		echo '<td title="'.$exibir_colunas['cor'].'">'.$exibir_colunas['cor'].'</td>';
		 		echo '<td title="'.$exibir_colunas['tamanho'].'">'.$exibir_colunas['tamanho'].'</td>';
		 		echo '<td title="'.$exibir_colunas['genero'].'">'.$exibir_colunas['genero'].'</td>';
		 		echo '<td title="'.$exibir_colunas['quantidade'].'">'.$exibir_colunas['quantidade'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_compra'].'">R$'.$exibir_colunas['valor_compra'].'</td>';
		 		echo '<td title="'.date('d/m/Y H:i:s', strtotime($exibir_colunas['data_compra'])).'">'.
		 		date('d/m/Y H:i:s', strtotime($exibir_colunas['data_compra'])).'</td>';
		 		echo '<td>'."<a href='../form_crud/form_insert_compra.php' title='Cadastrar compra'>INSERT</a> ".
		 		"<a href='../form_crud/form_select_compra.php' title='Listar compras'>SELECT</a> ".
		 		"<a href='../form_crud/form_update_compra.php' title='Atualizar compra'>UPDATE</a> ".
		 		"<a href='../form_crud/form_delete_compra.php' title='Deletar compra'>DELETE</a>".'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<script type="text/javascript" src="/web/js/compra/select_compra.js"></script> 
	<p><a href='../planilha/planilha_compra.php' target="_blank" title="Botão de download de planilha de compras"><button> Gerar planilha de compras </button></a></p>
</body>
</html>