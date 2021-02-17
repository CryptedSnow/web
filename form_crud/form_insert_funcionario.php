<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Cadastrar funcionário </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="/web/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/web/js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="/web/js/funcionario/mascara_funcionario.js"></script>
	<script type="text/javascript" src="/web/js/funcionario/senha_funcionario.js"></script>
	<script type="text/javascript" src="/web/js/alerta/alerta_insert.js" charset="UTF-8"></script>
</head>
<body>
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
					<li> <a href="/web/form_crud/caixa_venda.php" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/form_crud/caixa_devolucao.php" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
		</ul>
	</nav>

	<nav>
		<li> <a href="/web/form_crud/form_update_senha.php" title="Alterar senha"> Alterar senha </a> </li>
		<li> <a href="/web/logout.php" title="Sair do sistema"> Sair </a> </li> 
	</nav>
	<form method="POST" autocomplete="off" action="../crud/insert_funcionario.php" onsubmit="exibirNome()">
		<p> Nome: <input type="text" name="nome" id="nome" title="Campo para inserir o nome do funcionário" size="30" maxlength="30" required=""> </p>
		<p> CPF: <input type="text" name="cpf" id="cpf" size="30" title="Campo para inserir o CPF do funcionário" minlength="14" required=""> </p>
		<p> Telefone: <input type="text" name="telefone" id="telefone" title="Campo para inserir o telefone do funcionário" size="30" minlength="14" required=""> </p>
		<p> Email: <input type="email" name="email" id="email" title="Campo para inserir o email de login do funcionário" size="30" maxlength="50" required=""> </p>
		<p> Senha:
			<input type="password" name="senha" id="senha" title="Campo para inserir a senha de login do funcionário" size="30" maxlength="32" required="" onclick="mostrarSenha()">
			<i class="fa fa-eye" id="text" aria-hidden="true" title="Ocultar senha"></i>
			<i class="fa fa-eye-slash" id="pass" aria-hidden="true" title="Exibir senha"></i>
		</p>
		<button id="botao" name="Inserir" title="Botão para cadastrar o funcionário">Cadastrar funcionário</button>
	</form>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';
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
		    <th title="Ações"> Ações </th>
		</tr>
		<?php 
			// Loop para exibir as linhas
			foreach ($linhas as $exibir_colunas){
				echo '<tr>';
		 		echo '<td title="'.$exibir_colunas['cd_funcionario'].'">'.$exibir_colunas['cd_funcionario'].'</td>';
		 		echo '<td title="'.$exibir_colunas['nome'].'">'.$exibir_colunas['nome'].'</td>';
		 		echo '<td title="'.$exibir_colunas['cargo'].'">'.$exibir_colunas['cargo'].'</td>';
		 		echo '<td title="'.$exibir_colunas['cpf'].'">'.$exibir_colunas['cpf'].'</td>';
		 		echo '<td title="'.$exibir_colunas['telefone'].'">'.$exibir_colunas['telefone'].'</td>';
		 		echo '<td title="'.$exibir_colunas['email'].'">'.$exibir_colunas['email'].'</td>';
		 		echo '<td>'."<a href='../form_crud/form_insert_funcionario.php' title='Cadastrar funcionário'>INSERT</a> ".
		 		"<a href='../form_crud/form_select_funcionario.php' title='Listar funcionários'>SELECT</a> ".
		 		"<a href='../form_crud/form_update_funcionario.php' title='Atualizar funcionário'>UPDATE</a> ".
		 		"<a href='../form_crud/form_delete_funcionario.php' title='Deletar funcionário'>DELETE</a>".'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
</body>
</html>