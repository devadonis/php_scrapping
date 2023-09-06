function toggleNavbar(el) {
  var x = document.getElementById("myTopnav");

  el.classList.toggle("change");

  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function closeAlert(e) {
  e.parentElement.style.opacity = "0";
}
