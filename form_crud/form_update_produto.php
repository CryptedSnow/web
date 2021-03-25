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
	<title> Atualizar produto </title>
	<link rel="stylesheet" href="/web/css/css.css">
	<script type="text/javascript" src="/web/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/web/js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="/web/js/produto/mascara_produto.js"></script>
	<script type="text/javascript" src="/web/js/produto/exclusivo_feminino.js"></script>
	<script type="text/javascript" src="/web/js/produto/requisicao_produto.js"></script>
	<script type="text/javascript" src="/web/js/alerta/alerta_update.js" charset="UTF-8"></script>	 
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
		// Mostrar todos os erros do php
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);

		// Se a selecao for possivel de realizar
		try {
			// Query que seleciona chave e nome do produto
			$seleciona_nomes = $conexao->query("SELECT cd_produto, nome FROM produto ORDER BY cd_produto");
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
	<form method="POST" id="atu_pro" autocomplete="off" action="/web/crud/update_produto.php" onsubmit="exibirNome()">
		<p> ID produto:
		<select onclick="buscaDados()" name="cd_produto" id="cd_produto" required="" title="Caixa de seleção para escolher o produto a ser atualizado">
			<option value="" title="Opção vazia, escolha abaixo o produto a ser atualizado"> Nenhum </option>
  			<?php foreach($resultado_selecao as $valor): ?>
    			<option title="<?= $valor['nome'] ?>" value="<?= $valor['cd_produto'] ?>"><?= $valor['nome'] ?></option>
			<?php endforeach ?>
		</select>
		</p>
		<p> Tipo do produto:
      		<select name="nome" id="nome" required="" title="Caixa de seleção para atualizar o tipo do produto">
          		<option value="" title="Por padrão a opção é vazia, escolha abaixo o tamanho desejado"> Nenhum </option>
          		<option value="Camiseta" title="Opção Camiseta">Camiseta</option>
          		<option value="Calça" title="Opção Calça">Calça</option>
          		<option value="Bermuda" title="Opção Bermuda">Bermuda</option>
          		<option value="Jaqueta" title="Opção Jaqueta">Jaqueta</option>
          		<option value="Saia" title="Opção Saia">Saia</option>
          		<option value="Macacão" title="Opção Macacão">Macacão</option>
          		<option value="Vestido" title="Opção Vestido">Vestido</option>
      		</select>
  		</p>
  		<p> Marca:
      		<select name="marca" id="marca" required="" title="Caixa de seleção para atualizar a marca do produto">
          		<option value="" title="Por padrão a opção é vazia, escolha abaixo a marca desejada"> Nenhum </option>
          		<option value="Lacoste" title="Opção Lacoste">Lacoste</option>
          		<option value="Hollister" title="Opção Hollister">Hollister</option>
          		<option value="Polo Ralph Lauren" title="Opção Polo Ralph Lauren">Polo Ralph Lauren</option>
          		<option value="TOMMY HILFIGER" title="Opção Tommy Hilfiger">TOMMY HILFIGER</option>
          		<option value="Calvin Klein" title="Opção Calvin Klein">Calvin Klein</option>
          		<option value="Colcci" title="Opção Colcci">Colcci</option>
          		<option value="John John" title="Opção John John">John John</option>
          		<option value="Dudalina" title="Opção Dudalina">Dudalina</option>
          		<option value="Louis Vuitton" title="Opção Louis Vuitton">Louis Vuitton</option>
          		<option value="FARM" title="Opção FARM">FARM</option>
      		</select>
  		</p>
		<p> Código de barra: <input type="text" name="codigo_barra" id="codigo" title="Campo para atualizar o código de barra do produto" size="30" minlength="15" required=""> </p>
		<p> Cor:
      		<select name="cor" id="cor" required="" title="Caixa de seleção para atualizar a cor do produto">
          		<option value="" title="Por padrão a opção é vazia, escolha abaixo a cor desejada"> Nenhum </option>
          		<option value="Preto" title="Cor preta">Cor preta</option>
          		<option value="Branco" title="Cor branca">Cor nranca</option>
          		<option value="Cinza" title="Cor cinza">Cor cinza</option>
          		<option value="Vermelho" title="Cor vermelha">Cor vermelha</option>
          		<option value="Amarelo" title="Cor amarela">Cor amarela</option>
          		<option value="Azul" title="Cor azul">Cor azul</option>
          		<option value="Verde" title="Cor verde">Cor verde</option>
          		<option value="Laranja" title="Cor laranja">Cor laranja</option>
          		<option value="Rosa" title="Cor rosa">Cor rosa</option>
          		<option value="Vinho" title="Cor vinho">Cor vinho</option>
          		<option value="Marrom" title="Cor marrom">Cor marrom</option>
          		<option value="Roxa" title="Cor roxa">Cor roxa</option>
      		</select>
  		</p>
		<p> Tamanho:
			<select name="tamanho" id="tamanho" title="Caixa de seleção para atualizar o tamanho do produto" required="">
				<option value="" title="Opção vazia, escolha abaixo o tamanho desejado"> Nenhum </option>
	  			<option value="P" title="Tamanho P"> Tamanho P </option>
  				<option value="M" title="Tamanho M"> Tamanho M </option>
  				<option value="G" title="Tamanho G">  Tamanho G </option>
  				<option value="GG" title="Tamanho GG"> Tamanho GG </option>
			</select>
		</p>
		<p> Gênero:
			<select name="genero" id="genero" title="Caixa de seleção para atualizar o gênero do produto" required="" readonly="readonly" tabindex="-1" aria-disabled="true">
				<option value="" title="Opção vazia, escolha abaixo o tipo desejado"> Nenhum </option>
	  			<option value="M" title="Gênero masculino"> Gênero masculino </option>
  				<option value="F" title="Gênero feminino"> Gênero feminino </option>	
			</select>
		</p>
		<p> Quantidade: <input type="number"  name="quantidade" id="quantidade" pattern="\d+" title="Campo para atualizar a quantidade do produto" required=""> </p>
		<p> Valor de compra: <input type="number" step="any" name="valor_compra" id="valor_compra" title="Campo para atualizar o valor de compra do produto" required=""> </p>
		<p> Porcentagem de revenda:
			<select name="porcentagem_revenda" id="porcentagem_revenda" title="Caixa de seleção para atualizar a porcentagem de revenda do produto" required="">
				<option value="" title="Por padrão a opção é vazia, escolha abaixo a porcentagem desejado"> Nenhum </option>
	  			<option value="5" title="Opção 5%">5%</option>		
	  			<option value="10" title="Opção 10%">10%</option>
	  			<option value="15" title="Opção 15%">15%</option>		
	  			<option value="20" title="Opção 20%">20%</option>
	  			<option value="25" title="Opção 25%">25%</option>		
	  			<option value="30" title="Opção 30%">30%</option>
	  			<option value="35" title="Opção 35%">35%</option>			
	  			<option value="40" title="Opção 40%">40%</option>
	  			<option value="45" title="Opção 45%">45%</option>			
	  			<option value="50" title="Opção 50%">50%</option>
	  			<option value="55" title="Opção 55%">55%</option>			
	  			<option value="60" title="Opção 60%">60%</option>
	  			<option value="65" title="Opção 65%">65%</option>			
	  			<option value="70" title="Opção 70%">70%</option>
	  			<option value="75" title="Opção 75%">75%</option>			
	  			<option value="80" title="Opção 80%">80%</option>
	  			<option value="85" title="Opção 85%">85%</option>		
	  			<option value="90" title="Opção 90%">90%</option>
	  			<option value="95" title="Opção 95%">95%</option>		
	  			<option value="100" title="Opção 100%">100%</option>			
			</select>
		</p>
		<button name="Atualizar" title="Botão para atualizar o produto"> Botão atualizar produto </button>
	</form>
	<button href="#" onclick='window.scrollTo({top: 0, behavior: "smooth"})' title="Botão voltar ao topo">Botão topo da página</button>
</body>
</html>