function showHamburher(event) {

  $('.navIcon').toggleClass('toggle');


    var x = document.getElementById("desktopTabs");
    if (x.className === "desktopTabs") {
      x.className += " responsive";
    } else {
      x.className = "desktopTabs";
    }
  }