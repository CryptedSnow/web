// JS que especifica o genero de determinada peca de roupa. EX: Saia sempre sera de genero F
document.addEventListener("DOMContentLoaded", function(){
   	document.getElementById("nome").addEventListener("change", function(){
      	document.getElementById("genero").value = this.options[this.selectedIndex].dataset.f !== undefined ? "F" : "";
   	});
});