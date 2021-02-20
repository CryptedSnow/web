<?php
	// Arquivo conexao.php
	require_once '../conexao/conexao.php'; 
	// Arquivo classe_usuario.php
	require_once '../classe/classe_usuario.php';
	// Inicio da sessao
	session_start();
	// Se existir $_SESSION['id_usuario'] e $_SESSION['nome_usuario']
	if(isset($_SESSION['id_usuario']) && isset($_SESSION['nome_usuario'])){
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
<html>
<head>
	<meta charset="utf-8">
	<title> INSERT | PRODUTO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Inserir
		if(isset($_POST['Inserir'])){ 
			// Especifica a variavel
			$nome = $_POST['nome'];
			$marca = $_POST['marca'];
			$codigo_barra = $_POST['codigo_barra'];
			$cor = $_POST['cor'];
			$tamanho = $_POST['tamanho'];
			$genero = $_POST['genero'];
			$quantidade = intval($_POST['quantidade']);
			$valor_compra = floatval($_POST['valor_compra']);
			$porcentagem_revenda = intval($_POST['porcentagem_revenda']);
			$valor_revenda = floatval(($valor_compra + ($valor_compra * ($porcentagem_revenda / 100))));

			// Se a quantidade ou valor do item for menor/igual a zero
			if ($quantidade <= 0 || $valor_compra <= 0) { 
				echo "A quantidade ou valor de compra do produto não pode ser igual ou menor que zero, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_insert_produto.php" 
				title="Refazer a operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Se a insercao for possivel de realizar
			try {
				// Query que faz a insercao	
				$insercao = "INSERT INTO produto (nome,marca,codigo_barra,cor,tamanho,
				genero,quantidade,valor_compra,porcentagem_revenda,valor_revenda) 
				VALUES (:nome,:marca,:codigo_barra,:cor,:tamanho,:genero,:quantidade,
				:valor_compra,:porcentagem_revenda,:valor_revenda)";
				// $insere_dados recebe $conexao que prepare a operacao de insercao
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':nome',$nome);
				$insere_dados->bindValue(':marca',$marca);
				$insere_dados->bindValue(':codigo_barra',$codigo_barra);
				$insere_dados->bindValue(':cor',$cor);
				$insere_dados->bindValue(':tamanho',$tamanho);
				$insere_dados->bindValue(':genero',$genero);
				$insere_dados->bindValue(':quantidade',$quantidade);
				$insere_dados->bindValue(':valor_compra',$valor_compra);
				$insere_dados->bindValue(':porcentagem_revenda',$porcentagem_revenda);
				$insere_dados->bindValue(':valor_revenda',$valor_revenda);
				// Executa a operacao
				$insere_dados->execute();
				// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_produto.php');
			// Se a insercao nao for possivel de realizar
			} catch (PDOException $falha_insercao) {
			    echo "A inserção não foi feita".$falha_insercao->getMessage();
			    die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_insert_produto.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 			
	?>
</body>
</html>