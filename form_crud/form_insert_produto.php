<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"> 
	<title> Cadastrar produto </title>
	<link rel="stylesheet" href="/WEB/css/css.css">
	<script type="text/javascript" src="/WEB/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/WEB/js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="/WEB/js/produto/mascara_produto.js"></script>
	<script type="text/javascript" src="/WEB/js/produto/exclusivo_feminino.js"></script>
	<script type="text/javascript" src="/WEB/js/alerta/alerta_insert.js" charset="UTF-8"></script>	   
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
					<li> <a href="/web/crud/caixa_venda.php" title="Fluxo de vendas"> Fluxo de vendas </a> </li>
					<li> <a href="/web/crud/caixa_devolucao.php" title="Fluxo de devoluções"> Fluxo de devoluções </a> </li> 
				</ul>
			</li>
		</ul>
	</nav>

	<nav>
		<li> <a href="/web/form_crud/form_update_senha.php" title="Alterar senha"> Alterar senha </a> </li>
		<li> <a href="logout.php" title="Sair do sistema"> Sair </a> </li> 
	</nav> 
	<form method="POST" autocomplete="off" action="../crud/insert_produto.php" onsubmit="exibirNome()">
		<p> Roupa:
      		<select name="nome" id="nome" required="" title="Caixa de seleção para escolher a roupa">
          		<option value="" title="Por padrão a opção é vazia, escolha abaixo o tamanho desejado"> Nenhum </option>
          		<option value="Camiseta" title="Opção Camiseta">Camiseta</option>
          		<option value="Calça" title="Opção Calça">Calça</option>
          		<option value="Bermuda" title="Opção Bermuda">Bermuda</option>
          		<option value="Jaqueta" title="Opção Jaqueta">Jaqueta</option>
          		<option data-f value="Saia" title="Opção Saia">Saia</option>
          		<option data-f value="Macacão" title="Opção Macacão">Macacão</option>
          		<option data-f value="Vestido" title="Opção Vestido">Vestido</option>
      		</select>
  		</p>
  		<p> Marca:
      		<select name="marca" id="marca" required="" title="Caixa de seleção para escolher a marca da roupa">
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
		<p> Código de barra: <input type="text" id="codigo" name="codigo_barra" title="Campo para inserir o código de barra da peça de roupa" size="30" minlength="15" required=""> </p>
		<p> Cor:
      		<select name="cor" id="cor" required="" title="Caixa de seleção para inserir a cor da roupa">
          		<option value="" title="Por padrão a opção é vazia, escolha abaixo a cor desejada">Nenhum</option>
          		<option value="Preto" title="Cor preta">Preto</option>
          		<option value="Branco" title="Cor branca">Branco</option>
          		<option value="Cinza" title="Cor cinza">Cinza</option>
          		<option value="Vermelho" title="Cor vermelha">Vermelho</option>
          		<option value="Amarelo" title="Cor amarela">Amarelo</option>
          		<option value="Azul" title="Cor azul">Azul</option>
          		<option value="Verde" title="Cor verde">Verde</option>
          		<option value="Laranja" title="Cor laranja">Laranja</option>
          		<option value="Rosa" title="Cor rosa">Rosa</option>
          		<option value="Vinho" title="Cor vinho">Vinho</option>
          		<option value="Marrom" title="Cor marrom">Marrom</option>
          		<option value="Roxa" title="Cor roxa">Roxo</option>
      		</select>
  		</p>
		<p> Tamanho:
		<select name="tamanho" id="tamanho" title="Caixa de seleção para escolher o tamanho da roupa" required="">
			<option value="" title="Por padrão a opção é vazia, escolha abaixo o tamanho desejado"> Nenhum </option>
  			<option value="P" title="Opção tamanho P">P</option>
  			<option value="M" title="Opção tamanho M">M</option>
  			<option value="G" title="Opção tamanho G">G</option>
  			<option value="GG" title="Opção tamanho GG">GG</option>
		</select>
		</p>
		<p> Gênero:
		<select name="genero" id="genero" title="Caixa de seleção para escolher o gênero da roupa" required="">
			<option value="" title="Por padrão a opção é vazia, escolha abaixo o tipo desejado"> Nenhum </option>
  			<option value="M" title="Opção masculino">M</option>
  			<option value="F" datitle="Opção feminino">F</option>	
		</select>
		</p>
		<p> Quantidade: <input type="number" name="quantidade" id="quantidade" title="Campo para inserir a quantidade de peças de roupa" size=30 required=""> </p>
		<p> Valor de compra: <input type="number" step="any" name="valor_compra" id="valor_compra" title="Campo para inserir o valor de compra da peça de roupa" required=""> </p>
		<p> Porcentagem de revenda:
		<select name="porcentagem_revenda" id="porcentagem_revenda" 
		title="Caixa de seleção para escolher a porcentagem de revenda" required="">
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
		<button name="Inserir" title="Botão para cadastrar o produto">Cadastrar produto</button>
	</form>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php'; 
		// Se a selecao for possivel de realizar
		try {
			// Query que faz a selecao
			$selecao = "SELECT * FROM produto";
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
			<th title="Produto"> Produto </th>
			<th title="Marca"> Marca </th>
			<th title="Código de barra"> Código de barra </th> 
		    <th title="Cor"> Cor </th>
		    <th title="Tamanho"> Tamanho </th>
		    <th title="Gênero"> Gênero </th>
		    <th title="Quantidade"> Quantidade </th>
		    <th title="Valor de compra"> Valor de compra </th>
		    <th title="Porcentagem de revenda"> Porcentagem de revenda </th>
		    <th title="Valor de revenda"> Valor de revenda </th>
		    <th title="Ações"> Ações </th>
		</tr>
		<?php 
			// Loop para exibir as linhas
			foreach ($linhas as $exibir_colunas){
				echo '<tr>';
		 		echo '<td title="'.$exibir_colunas['cd_produto'].'">'.$exibir_colunas['cd_produto'].'</td>';
		 		echo '<td title="'.$exibir_colunas['nome'].'">'.$exibir_colunas['nome'].'</td>';
		 		echo '<td title="'.$exibir_colunas['marca'].'">'.$exibir_colunas['marca'].'</td>';
		 		echo '<td title="'.$exibir_colunas['codigo_barra'].'">'.$exibir_colunas['codigo_barra'].'</td>';
		 		echo '<td title="'.$exibir_colunas['cor'].'">'.$exibir_colunas['cor'].'</td>';
		 		echo '<td title="'.$exibir_colunas['tamanho'].'">'.$exibir_colunas['tamanho'].'</td>';
		 		echo '<td title="'.$exibir_colunas['genero'].'">'.$exibir_colunas['genero'].'</td>';
		 		echo '<td title="'.$exibir_colunas['quantidade'].' produto(s)">'.$exibir_colunas['quantidade'].'</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_compra'].'">R$'.$exibir_colunas['valor_compra'].'</td>';
		 		echo '<td title="'.$exibir_colunas['porcentagem_revenda'].'%">'.$exibir_colunas['porcentagem_revenda'].'%</td>';
		 		echo '<td title="R$'.$exibir_colunas['valor_revenda'].'">R$'.$exibir_colunas['valor_revenda'].'</td>';
		 		echo '<td>'."<a href='../form_crud/form_insert_produto.php' title='Cadastrar produto'>INSERT</a> ".
		 		"<a href='../form_crud/form_select_produto.php' title='Listar produtos'>SELECT</a> ".
		 		"<a href='../form_crud/form_update_produto.php' title='Atualizar produto'>UPDATE</a> ".
		 		"<a href='../form_crud/form_delete_produto.php' title='Deletar produto'>DELETE</a>".'</td>';
		 		echo '</tr>'; echo '</p>';
			}
		?>
	</table>
</body>
</html> 