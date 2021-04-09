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
	<title> Excluir devolução </title>
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

			// Query que seleciona chave da tabela devolucao
			$seleciona_nomes = $conexao->query("SELECT cd_devolucao FROM devolucao ORDER BY cd_devolucao");
			// Resulta em uma matriz
			$resultado_selecao = $seleciona_nomes->fetchAll();

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
	<form method="POST" id="exc_dev" autocomplete="off" action="/web/crud/delete_devolucao.php" onsubmit="exibirNome()">
		<fieldset>
		<legend> Excluir devolução (Atalho = Alt + w) </legend>
		<p> ID devolução:
			<select name="cd_devolucao" required="" id="cd_devolucao" accesskey="w" title="Caixa de seleção para escolher a devolução a ser excluída">
				<option value="" title="Opção vazia, escolha abaixo o item devolvido a ser excluído"> Nenhum </option>
				<?php foreach($resultado_selecao as $valor): ?>
    				<option title="<?= $valor['cd_devolucao'] ?>" value="<?= $valor['cd_devolucao'] ?>"><?= $valor['cd_devolucao'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<button name="Deletar" title="Botão para excluir a devolução"> Botão deletar devolução </button>
		</fieldset>
	</form>
	<?php
		// Se a selecao for possivel de realizar
		try {
			// Query que faz a seleção
			$selecao = "SELECT devolucao.cd_devolucao,
			venda.cd_venda, produto.nome, venda.valor_item,
			devolucao.quantidade, venda.quantidade AS qtd_vendida,
			produto.quantidade AS estoque, 
			devolucao.valor_devolucao, devolucao.motivo_devolucao, 
			devolucao.data_devolucao FROM devolucao
			INNER JOIN venda ON (venda.cd_venda = devolucao.cd_venda)
			INNER JOIN produto ON (produto.cd_produto = devolucao.cd_produto)";
			// $seleciona_dados recebe $conexao que prepare a operacao para selecionar
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
	<table border="1">
		<tr> 
			<th title="ID"> ID </th>
			<th title="ID venda"> ID venda </th>
			<th title="Produto"> Produto </th>
			<th title="Valor item"> Valor item </th>
			<th title="Quantidade devolvida"> Qtd devolvida </th>
			<th title="Quantidade vendida"> Qtd vendida </th>
			<th title="Estoque"> Estoque </th>  
			<th title="Valor da devolução"> Valor da devolução </th>
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
		 		echo '<td title="'.$exibir_colunas['qtd_vendida'].' produto(s) vendido(s)">'.$exibir_colunas['qtd_vendida'].'</td>';
		 		echo '<td title="'.$exibir_colunas['estoque'].' produto(s) em estoque">'.$exibir_colunas['estoque'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_devolucao'].'">R$'.$exibir_colunas['valor_devolucao'].'</td>';
		 		echo '<td title="'.$exibir_colunas['motivo_devolucao'].'">'.$exibir_colunas['motivo_devolucao'].'</td>';
		 		echo '<td title="'.date('d/m/Y H:i:s', strtotime($exibir_colunas['data_devolucao'])).'">'.
		 		date('d/m/Y H:i:s', strtotime($exibir_colunas['data_devolucao'])).'</td>';
		 		echo '<td>'."<a href='/web/form_crud/form_insert_devolucao.php/#cad_dev' title='Cadastrar devolução'>Cadastrar</a> ".
		 		"<a href='/web/form_crud/form_select_devolucao.php/#nome' title='Listar devoluções'>Listar</a>";
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<br/>
	<button href="#" onclick='window.scrollTo({top: 0, behavior: "smooth"})' title="Botão voltar ao topo">Botão topo da página</button>
</body> 
</html> 