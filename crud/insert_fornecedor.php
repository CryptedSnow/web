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
		echo "";
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
<html>
<head>
	<meta charset="utf-8">
	<title> INSERT | FORNECEDOR </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Inserir
		if(isset($_POST['Inserir'])){
			// Especifica a variavel
			$nome = strval($_POST['nome']);
			$cnpj = strval($_POST['cnpj']);
			$telefone = strval($_POST['telefone']);
			$email = strval($_POST['email']);
			$estado = strval($_POST['estado']);
			$cidade = strval($_POST['cidade']);
			$bairro = strval($_POST['bairro']);
			$endereco = strval($_POST['endereco']);
			$numero = intval($_POST['numero']);
			// Se a insercao for possivel de realizar
			try {
				// Query que faz a insercao
				$insercao = "INSERT INTO fornecedor (nome,cnpj,telefone,email,estado,cidade,bairro,endereco,numero) 
				VALUES (:nome,:cnpj,:telefone,:email,:estado,:cidade,:bairro,:endereco,:numero)";
				// $insere_dados recebe $conexao que prepare a operacao de insercao
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':nome', $nome);
				$insere_dados->bindValue(':cnpj', $cnpj);
				$insere_dados->bindValue(':telefone', $telefone);
				$insere_dados->bindValue(':email', $email);
				$insere_dados->bindValue(':estado', $estado);
				$insere_dados->bindValue(':cidade', $cidade);
				$insere_dados->bindValue(':bairro', $bairro);
				$insere_dados->bindValue(':endereco', $endereco);
				$insere_dados->bindValue(':numero', $numero);
				// Executa a operacao
				$insere_dados->execute();
				// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_fornecedor/#nome.php');
				die();
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
			echo '<p><a href="../form_crud/form_insert_fornecedor/#cad_forn.php" 
			title="Refazer operação"><button>Botão refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>