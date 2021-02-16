// JS que faz a requisicao de dados
function buscaDados(){
    // Variavel cd_compra_fornecedor que retorna o elemento cd_compra_fornecedor
    var cd_compra_fornecedor = document.querySelector("#cd_compra_fornecedor").value;
    // Verifica se o option selecionado e vazio (value="")
    if(!cd_compra_fornecedor){
    	// Apaga os valores dos elementos do formulario
      document.forms[0].reset();
      // Aborta o resto da funcao
      return;
   	}
    // Instancia a classe XMLHttpReques
    ajax = new XMLHttpRequest();
    // Especifica o Method e a url que sera chamada
    ajax.open("GET","/web/json/id_compra.php?cd_compra_fornecedor="+cd_compra_fornecedor,true);
    // Executa na resposta do ajax
    ajax.onreadystatechange = function(){
    	// Se completar a requisicao
	    if(ajax.readyState == 4){
	        // Se retornar
		    if(ajax.status == 200){
		      // Converte a string retornada para dados em JSON no JS
		      var retornoJson = JSON.parse(ajax.responseText);
		      // Preenche os campos com o retorno dos dados em cada campo
		      document.querySelector("#cd_compra_fornecedor").value = retornoJson[0].cd_compra_fornecedor;
		      document.querySelector("#cd_fornecedor").value = retornoJson[0].cd_fornecedor;
		      document.querySelector("#cd_produto").value = retornoJson[0].cd_produto;
		    }
	    }
    }
  // Envia a solicitacao
  ajax.send();
}