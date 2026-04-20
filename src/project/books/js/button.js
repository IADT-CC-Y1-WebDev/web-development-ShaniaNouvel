function openDash(evt, dash) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" activeDash", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(dash).style.display = "grid";
    evt.currentTarget.className += " activeDash";
}

function addNew(show) {
    document.getElementById(show).classList.toggle("hideDiv");
}

function addButton(button) {
    let card = button.closest('.card')
    let togglebtn = card.querySelector('.hideDiv');

    if (togglebtn.style.display === "none" || togglebtn.style.display === "") {
        togglebtn.style.display = "flex";
    } else {
        togglebtn.style.display = "none";
    }
}
