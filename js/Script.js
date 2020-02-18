function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function selectionView(choice) {
    document.getElementById("checkboxvalue").style.visibility = "visible";
    var tab = [];

    $.each($('input:checked'), function() {
      tab.push(choice);
    });

    $('p').text(tab.join(" ### "));

}

