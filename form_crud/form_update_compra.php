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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"> 
	<title> Atualizar compra </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<script type="text/javascript" src="/web/js/compra/requisicao_compra.js"></script>
	<script type="text/javascript" src="/web/js/alerta/alerta_update.js" charset="UTF-8"></script>
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
			$resultado_compra = $seleciona_compra->fetchAll();	

			// Query que seleciona chave e nome do fornecedor
			$seleciona_fornecedor = $conexao->query("SELECT cd_fornecedor, nome FROM fornecedor");
			// Resulta em uma matriz
			$resultado_fornecedor = $seleciona_fornecedor->fetchAll();

			// Query que seleciona chave e nome do produto
			$seleciona_produto = $conexao->query("SELECT cd_produto, nome FROM produto");
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
					<li> <a href="/web/form_crud/caixa_venda.php" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/form_crud/caixa_devolucao.php" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
			<li class="submenu"> <a> Configurações </a>
				<ul>
					<li> <a href="/web/form_crud/form_update_senha.php" title="Alterar senha"> Alterar senha </a> </li>
					<li> <a href="/web/form_crud/form_area_adm.php" title="Área Administrador"> Área Administrador </a> </li> 
				</ul>
			</li>
			<li> <a href="/web/logout.php" title="Sair do sistema"> Sair </a> </li> 
		</ul>
	</nav>
 
	<form method="POST" autocomplete="off" action="../crud/update_compra.php" onsubmit="exibirNome()">
		<p> ID compra:
		<select onclick="buscaDados()" name="cd_compra_fornecedor" id="cd_compra_fornecedor" required="" title="Caixa de seleção para escolher a compra a ser atualizada">
			<option value="" title="Opção vazia, escolha a compra a ser atualizado"> Nenhum </option>
			<?php foreach($resultado_compra as $valor): ?>
    			<option title="<?= $valor['cd_compra_fornecedor'] ?>" 
    			value="<?= $valor['cd_compra_fornecedor'] ?>"><?= $valor['cd_compra_fornecedor'] ?></option>
			<?php endforeach ?>
		</select>
		</p>
		<p> ID fornecedor:
			<select name="cd_fornecedor" id="cd_fornecedor" required="" title="Caixa de seleção para atualizar o fornecedor">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo o fornecedor"> Nenhum </option>
	  			<?php foreach($resultado_fornecedor as $v1): ?>
    				<option title="<?= $v1['nome'] ?>" value="<?= $v1['cd_fornecedor'] ?>"><?= $v1['nome'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<p> ID produto:
			<select name="cd_produto" id="cd_produto" required="" title="Caixa de seleção para atualizar o produto">
				<option value="" title="Por padrão a opção é vazia, escolha o produto desejado"> Nenhum </option>
	  			<?php foreach($resultado_produto as $v2): ?>
    				<option title="<?= $v2['nome'] ?>" value="<?= $v2['cd_produto'] ?>"><?= $v2['nome'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<button name="Atualizar" id="botao" title="Botão para atualizar a compra"> Atualizar compra </button>
		<button type="reset" title="Botão para limpar os campos dos formulário"> Limpar formulário </button>
	</form>
</body>
</html> 