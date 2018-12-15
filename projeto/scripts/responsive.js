function showHamburher(event) {

  $('.navIcon').toggleClass('toggle');

    var x = document.getElementById("desktopTabs");
    if (x.style.width=="100vw") {
      x.style.width = "0";
      x.style.padding= "0";
    } else {
      x.style.width = "100vw";
      x.style.padding= "1.5em";
    }
}

function showDropDown(event) {
  var x = document.getElementById("dropDown");
   
    if (x.style.height=="auto") {
      x.style.height = "0";
      x.style.fontSize = "0";
    } else {
      x.style.height = "auto";
      x.style.fontSize = "20px";
    }
}