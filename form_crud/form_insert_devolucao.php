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
	<title> Cadastrar devolução </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<script type="text/javascript" src="/web/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/web/js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="/web/js/devolucao/mascara_devolucao.js"></script>
	<script type="text/javascript" src="/web/js/devolucao/requisicao_venda.js"></script>
	<script type="text/javascript" src="/web/js/alerta/alerta_insert.js" charset="UTF-8"></script>
</head>
<body>
	<?php
	
		// Mostrar todos os erros do php
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);

		// Se a selecao for possivel de realizar
		try {

			// Query que seleciona chave da tabela venda
			$seleciona_venda = $conexao->query("SELECT cd_venda, quantidade FROM venda");
			// Resulta em uma matriz
			$resultado_venda = $seleciona_venda->fetchAll();

			// Query que seleciona chave e nome do produto
			$seleciona_produto = $conexao->query("SELECT cd_produto, nome, quantidade FROM produto");
			// Resulta em uma matriz
			$resultado_produto = $seleciona_produto->fetchAll();

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
					<li> <a href="/web/crud/caixa_venda.php" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/crud/caixa_devolucao.php" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
			<li> <a href="/web/form_crud/form_update_senha.php" title="Alterar senha"> Alterar senha </a> </li>
			<li> <a href="/web/logout.php" title="Sair do sistema"> Sair </a> </li> 
		</ul>
	</nav>
	
	<form method="POST" autocomplete="off" action="../crud/insert_devolucao.php" onsubmit="exibirNome()">
		<p> ID venda:
			<select onclick="buscaDados()" name="cd_venda" id="cd_venda" required="" title="Caixa de seleção para escolher um ID da venda">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo ID da venda"> Nenhum </option>
				<?php foreach($resultado_venda as $v1): ?>
    				<option title="<?= $v1['cd_venda'] ?>" value="<?= $v1['cd_venda'] ?>"><?= $v1['cd_venda'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<p> Produto:
			<select name="cd_produto" id="cd_produto" required="" title="Caixa de seleção para escolher a peça de roupa" readonly="readonly" tabindex="-1" aria-disabled="true">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo a peça de roupa desejada"> Nenhum </option>
				<?php foreach($resultado_produto as $v2): ?>
    				<option title="<?= $v2['nome'] ?>" value="<?= $v2['cd_produto'] ?>"><?= $v2['nome'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<p> Valor do item: <input type="number" step="any" name="valor_item" id="valor_item" placeholder="R$0.00" title="Campo para inserir o valor do produto" size=30 required="" readonly="readonly"> </p>
		<p> Quantidade:
			<select name="quantidade" id="quantidade" required="" title="Caixa de seleção para escolher a quantidade para devolução">
				<option value="0" title="Por padrão a opção é zero, escolha abaixo a quantidade desejada" selected> 0 unidades </option>
				<?php
					
				?>
			</select>
		</p>
		<p> Motivo da devolução:
			<select name="motivo_devolucao" required="" title="Caixa de seleção para escolher o motivo da devolução">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo o motivo da devolução">Nenhum selecionado</option>
				<option value="Produto danificado" title="Produto danificado">Produto danificado</option>
				<option value="Tamanho errado" title="Tamanho errado">Tamanho errado</option>
				<option value="Gênero errado de roupa" title="Gênero errado de roupa">Gênero errado de roupa</option>
				<option value="Arrependimento de compra" title="Arrependimento de compra">Arrependimento de compra</option>
			</select>
		</p>
		<button name="Inserir" title="Botão para cadastrar a devolução"> Cadastrar devolução </button>
		<button type="reset" title="Botão para limpar todos os campos do formulário"> Limpar formulário </button>
	</form>
</body>
</html>