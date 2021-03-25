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
	// Caso o usuario atual seja diferente de ADM
	if ($_SESSION['cargo_usuario'] != "Administrador") {
		echo "<script> alert('{$_SESSION['nome_usuario']}, só o administrador pode acessar essa área.'); location.href='/web/inicio.php' </script>";
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
	<title> Área administrador </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<script type="text/javascript" src="/web/js/funcionario/requisicao_adm.js"></script>
	<script type="text/javascript" src="/web/js/alerta/alerta_adm.js" charset="UTF-8"></script>
	<script type="text/javascript" src="/web/js/alerta/alerta_exclusao_usuario.js" charset="UTF-8"></script>
</head>
<body>
	<?php
		// Mostrar todos os erros do php
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);
		// Se a selecao for possivel de realizar
		try {
			// Query que seleciona chave e nome do funcionario
			$seleciona_funcionario = $conexao->query("SELECT cd_funcionario, nome FROM funcionario 
			WHERE cargo != 'Administrador' ORDER BY cd_funcionario");
			// Resulta em uma matriz
			$resultado_funcionario = $seleciona_funcionario->fetchAll();
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
	<form method="POST" id="area_adm" autocomplete="off" action="/web/crud/area_adm.php" onsubmit="exibirNome()">
		<fieldset>
		<legend> Atualizar cargo do funcionário </legend>
		<p> ID funcionário:
			<select onclick="buscaDados()" name="cd_funcionario" id="cd_funcionario" required="" title="Caixa de seleção para escolher o funcionário">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo o funcionário"> Nenhum </option>
	  			<?php foreach($resultado_funcionario as $v1): ?>
    				<option title="<?= $v1['nome'] ?>" value="<?= $v1['cd_funcionario'] ?>"><?= $v1['nome'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<p> Cargo atual:
      		<select name="cargo" id="cargo" required="" title="Cargo atual do funcionário" readonly="readonly" tabindex="-1" aria-disabled="true">
          		<option value="" title="Por padrão a opção é vazia"> Nenhum </option>
          		<option value="Atendente" title="Cargo atendente"> Cargo atendente </option>
          		<option value="Gerente" title="Cargo gerente"> Cargo gerente </option>
      		</select>
  		</p>
		<p> Novo cargo:
      		<select name="novo_cargo" required="" title="Novo cargo do funcionário">
          		<option value="" title="Por padrão a opção é vazia"> Nenhum </option>
          		<option value="Atendente" title="Cargo atendente"> Cargo atendente </option>
          		<option value="Gerente" title="Cargo gerente"> Cargo gerente </option>
      		</select>
  		</p>
		<button name="Atualizar" title="Botão para atualizar cargo do funcionário"> Botão atualizar cargo funcionário </button>
		</fieldset>
	</form>

	<form method="POST" autocomplete="off" action="/web/crud/delete_usuario.php" onsubmit="exibirExclusao()">
		<fieldset>
		<legend> Excluir funcionário </legend>
		<p> ID funcionário:
			<select name="cd_funcionario" id="cd_funcionario" required="" title="Caixa de seleção para escolher o funcionário a ser excluído">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo o funcionário"> Nenhum </option>
	  			<?php foreach($resultado_funcionario as $v1): ?>
    				<option title="<?= $v1['nome'] ?>" value="<?= $v1['cd_funcionario'] ?>"><?= $v1['nome'] ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<button name="Deletar" title="Botão para excluir o funcionário"> Botão excluir funcionário </button>
		</fieldset>
		
	</form>
	<?php
		// Se a seleca for possivel de realizar
		try {
			// Query que faz a selecao
			$selecao = "SELECT * FROM funcionario WHERE cargo != 'Administrador'";
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
			<th title="Nome"> Nome </th> 
			<th title="Cargo"> Cargo </th>
			<th title="CPF"> CPF </th> 
		    <th title="Telefone"> Telefone </th>
		    <th title="Email"> Email </th>
		</tr>
		<?php 
			// Loop para exibir as linhas
			foreach ($linhas as $exibir_colunas){
				echo '<tr>';
		 		echo '<td title="'.$exibir_colunas['cd_funcionario'].'">'.$exibir_colunas['cd_funcionario'].'</td>';
		 		echo '<td title="'.$exibir_colunas['nome'].'">'.$exibir_colunas['nome'].'</td>';
		 		echo '<td title="'.$exibir_colunas['cargo'].'">'.$exibir_colunas['cargo'].'</td>';
		 		echo '<td title="'.substr_replace($exibir_colunas['cpf'], '***.***', 4, -3).'">'.substr_replace($exibir_colunas['cpf'], '***.***', 4, -3).'</td>';
		 		echo '<td title="'.$exibir_colunas['telefone'].'">'.$exibir_colunas['telefone'].'</td>';
		 		echo '<td title="'.substr_replace($exibir_colunas['email'], '****', 1, strpos($exibir_colunas['email'], '@') 
		 		- 2).'">'.substr_replace($exibir_colunas['email'], '****', 1, strpos($exibir_colunas['email'], '@') - 2).'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
	<br/>
	<button href="#" onclick='window.scrollTo({top: 0, behavior: "smooth"})' title="Botão voltar ao topo">Botão topo da página</button>
</body>
</html>