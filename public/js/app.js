

// sidebar submenu open close js code
function yesnoCheck(that) {
    if (that.value == "nonBoursier") {
        document.getElementById("Section1").style.display = "block";
  
    } else {
        document.getElementById("Section1").style.display = "none";
  
    }
    if(that.value == "boursierNL"){
        document.getElementById("Section2").style.display = "block";
    }else{
        document.getElementById("Section2").style.display = "none";
  
    }
    
    if(that.value == "boursierLoge"){
        document.getElementById("Section3").style.display = "flex";
    }else{
        document.getElementById("Section3").style.display = "none";
  
    }

    if(that.value == "affect"){
        document.getElementById("affecter").style.display = "flex";
    }else{
        document.getElementById("affecter").style.display = "none";
    }

    if(that.value == "add"){
        document.getElementById("ajouter").style.display = "flex";
    }else{
        document.getElementById("ajouter").style.display = "none";
    }

}

//Message
$(document).ready(function(){
    $("#message").show().fadeIn(3000).css("color","blue")
});