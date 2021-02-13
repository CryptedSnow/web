// JS que especifica o gênero de determinada peça de roupa. EX: Saia sempre será de gênero F
document.addEventListener("DOMContentLoaded", function(){
   	document.getElementById("nome").addEventListener("change", function(){
      	document.getElementById("genero").value = this.options[this.selectedIndex].dataset.f !== undefined ? "F" : "";
   	});
});