// JS que especifica o g�nero de determinada pe�a de roupa. EX: Saia sempre ser� de g�nero F
document.addEventListener("DOMContentLoaded", function(){
   	document.getElementById("nome").addEventListener("change", function(){
      	document.getElementById("genero").value = this.options[this.selectedIndex].dataset.f !== undefined ? "F" : "";
   	});
});