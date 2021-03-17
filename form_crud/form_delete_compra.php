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
	<title> Excluir compra </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<script type="text/javascript" src="/web/js/alerta/alerta_delete.js" charset="UTF-8"></script>
</head>
<body>
	<?php

		// Mostrar todos os erros do php
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);

		// Se a selecao for possivel de realizar
		try {
			// Query que seleciona chave da tabela compra_fornecedor
			$seleciona_compra = $conexao->query("SELECT cd_compra_fornecedor FROM compra_fornecedor");
			// Resulta em uma matriz
			$resultado_selecao = $seleciona_compra->fetchAll();	
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
					<li> <a href="/web/form_crud/form_update_compra.php/#atu_com" title="Atualizar compra"> Atualizar compra </a> </li>
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
	<form method="POST" id="exc_com" autocomplete="off" action="/web/crud/delete_compra.php" onsubmit="exibirNome()">
		<p> ID compra:
			<select name="cd_compra_fornecedor" required="" id="cd_compra_fornecedor" 
			title="Caixa de seleção para escolher a compra a ser excluída">
				<option value="" title="Opção vazia, escolha abaixo a compra a ser excluída"> Nenhum </option>
	  			<?php foreach($resultado_selecao as $valor): ?>
    				<option title="<?= $valor['cd_compra_fornecedor'] ?>" 
    				value="<?= $valor['cd_compra_fornecedor'] ?>"><?= $valor['cd_compra_fornecedor'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<button name="Deletar" title="Botão para excluir a compra"> Botão deletar compra </button>
	</form>
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
	<table border="1">
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
		 		echo '<td>'."<a href='/web/form_crud/form_insert_compra.php/#cad_com' title='Cadastrar compra'>Cadastrar</a> ".
		 		"<a href='/web/form_crud/form_select_compra.php/#nome' title='Listar compras'>Listar</a> ".
		 		"<a href='/web/form_crud/form_update_compra.php/#atu_com' title='Atualizar compra'>Atualizar</a>";
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<br/>
	<button href="#" onclick='window.scrollTo({top: 0, behavior: "smooth"})' title="Botão voltar ao topo">Botão topo da página</button>
</body> 
</html> 