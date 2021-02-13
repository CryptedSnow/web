// JS que faz a requisi��o de dados
function buscaDados() {
	// Variavel cd_itens_venda que retorna o elemento cd_itens_venda
	var cd_venda = document.querySelector("#cd_venda").value;
	// Verifica se o option selecionado � vazio (value="")
	if(!cd_venda) {
		// Apaga os valores dos elementos do formul�rio
		document.forms[0].reset();
		// Aborta o resto da fun��o 
		return;
	}
	// Instancia a classe XMLHttpReques
	ajax = new XMLHttpRequest();
	// Especifica o Method e a url que ser� chamada
	ajax.open("GET","/WEB/json/id_venda.php?cd_venda="+cd_venda,true);
	// Executa na resposta do ajax
	ajax.onreadystatechange = function() {
		// Se completar a requisi��o
		if (ajax.readyState == 4) {
			// Se retornar
			if (ajax.status == 200) {
				// Converte a string retornada para dados em JSON no JS
				var retornoJson = JSON.parse(ajax.responseText);
				// Preenche os campos com o retorno dos dados em cada campo
				document.querySelector("#cd_produto").value = retornoJson[0].cd_produto;
				document.querySelector("#valor_item").value = retornoJson[0].valor_item;
				document.querySelector("#quantidade").value = retornoJson[0].quantidade;
			}
		}
	}
	// Envia a solicita��o
	ajax.send();
}