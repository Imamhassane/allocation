

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
      



// search-box open close js code
let navbar = document.querySelector(".navbar");
let searchBox = document.querySelector(".search-box .bx-search");
// let searchBoxCancel = document.querySelector(".search-box .bx-x");

searchBox.addEventListener("click", ()=>{
  navbar.classList.toggle("showInput");
  if(navbar.classList.contains("showInput")){
    searchBox.classList.replace("bx-search" ,"bx-x");
  }else {
    searchBox.classList.replace("bx-x" ,"bx-search");
  } 
});

// sidebar open close js code
let navLinks = document.querySelector(".nav-links");
let menuOpenBtn = document.querySelector(".navbar .bx-menu");
let menuCloseBtn = document.querySelector(".nav-links .bx-x");
menuOpenBtn.onclick = function() {
navLinks.style.left = "0";
}
menuCloseBtn.onclick = function() {
navLinks.style.left = "-100%";
}


// sidebar submenu open close js code






    