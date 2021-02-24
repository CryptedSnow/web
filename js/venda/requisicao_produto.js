function buscaDados(){
    // Variavel cd_produto que retorna o elemento cd_produto
    var cd_produto = document.querySelector("#cd_produto").value;
    // Verifica se o option selecionado e vazio (value="")
    if(!cd_produto){
    	// Apaga os valores dos elementos do formulario
      document.forms[0].reset();
      // Aborta o resto da funcao 
      return;
   	}
    // Instancia a classe XMLHttpReques
    ajax = new XMLHttpRequest();
    // Especifica o Method e a url que sera chamada
    ajax.open("GET","/web/json/id_produto.php?cd_produto="+cd_produto,true);
    // Executa na resposta do ajax
    ajax.onreadystatechange = function(){
    	// Se completar a requisicao
	    if(ajax.readyState == 4){
	        // Se retornar
		    if(ajax.status == 200){
		     	// Converte a string retornada para dados em JSON no JS
		      var retornoJson = JSON.parse(ajax.responseText);
		      // Preenche os campos com o retorno dos dados em cada campo
		      document.querySelector("#valor_item").value = retornoJson[0].valor_revenda;
          document.querySelector("#quantidade").value = retornoJson[0].quantidade;
          let elemento = document.getElementById("quantidade");
          elemento.innerHTML = "";
          // Loop que cria varios options no campo quantidade
          for (let i = 0; i <= retornoJson[0].quantidade; i++) {
            let option = document.createElement("option");
            option.text = option.elemento = i;
            if (i == 0) {
              option.setAttribute("title","Por padrão a opção é zero, escolha abaixo a quantidade desejada.");
            }
            option.setAttribute("value", i);
            elemento.appendChild(option);
          }
		    }
	    }
    }
  ajax.send();
}