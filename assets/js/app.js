(function() {
  "use strict"

const reset = function() {
  const input = document.querySelectorAll(".inputput");
  return input.forEach(function(el) {
  return el.value = "";
  })
};

const init = function() {
  const input = document.querySelectorAll(".inputput")
  const nettoyage = document.querySelectorAll('.emptyInput');
  nettoyage.forEach(function(el){
  el.onclick = function() {
    console.log(reset());
  }
  });
}

window.addEventListener("DOMContentLoaded", init)
})()
