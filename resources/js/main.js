if (typeof(Storage) !== "undefined") {
    var current = localStorage.recent;
    if (current) {

        var tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        } 
        var tablink = document.getElementsByClassName("tablink");
        for (i = 0; i < tablink.length; i++) {
            tablink[i].classList.remove("active");
        } 
        if (current == "link1")
            document.getElementById("signin").style.display = "block";
        else
            document.getElementById("signup").style.display = "block";
        document.getElementById(current).classList.add("active");
    }
}

function openTab(evt, choice) {

    var tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    } 
    var tablink = document.getElementsByClassName("tablink");
    for (i = 0; i < tablink.length; i++) {
        tablink[i].classList.remove("active");
    } 
    document.getElementById(choice).style.display = "block";
    evt.currentTarget.classList.add("active");
   
    if (typeof(Storage) !== "undefined") {
        localStorage.recent = evt.currentTarget.getAttribute('id');
    }
}

function validateLogin() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var useremail = document.getElementById("loginuseremail").value;
    var userpass = document.getElementById("loginuserpass").value;
    var result = true;
    if (useremail == "") {
        required[0].innerHTML = "No se puede el dejar campos vacío";
        result = false;
    } else if (!validateEmail(useremail)) {
        required[0].innerHTML = "Formato de Email inválido";
        result = false;
    }
    if (userpass == "") {
        required[1].innerHTML = "No se puede el dejar campos vacío";
        result = false;
    }
    return result;
}

function validateRegister() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var userfirstname = document.getElementById("userfirstname").value;
    var userlastname = document.getElementById("userlastname").value;
    var userpass = document.getElementById("userpass").value;
    var userpassconfirm = document.getElementById("userpassconfirm").value;
    var useremail = document.getElementById("useremail").value;
    var usergender = document.getElementsByClassName("usergender");
    var result = true;
    if (userfirstname == "") {
        required[2].innerHTML = "No se puede el dejar campos vacío";
        result = false;
    }
    if (userlastname == "") {
        required[3].innerHTML = "No se puede el dejar campos vacío";
        result = false;
    }
    if (userpass == "") {
        required[5].innerHTML = "No se puede el dejar campos vacío";
        result = false;
    }
    if (userpassconfirm == "") {
        required[6].innerHTML = "No se pueden dejar campos vacío";
        result = false;
    }
    if (userpass != "" && userpassconfirm != "" && userpass != userpassconfirm) {
        required[5].innerHTML = "Contraseña no coincide";
        required[6].innerHTML = "Contraseña no coincide";
        result = false;
    }
    if (useremail == "") {
        required[7].innerHTML = "No se puede el dejar campos vacío";
        result = false;
    } else if (!validateEmail(useremail)) {
        required[7].innerHTML = "Email incorrecto";
        result = false;
    }
    if (!usergender[0].checked && !usergender[1].checked) {
        required[8].innerHTML = "Debes definir el genero";
        result = false;
    }
    return result;
}

function clearRequiredFields() {
    var required = document.getElementsByClassName("required");
    for (i = 0; i < required.length; i++) {
        required[i].innerHTML = "";
    }
}

function validateEmail(email) {
    var emailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\"[^\s@]+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!email.match(emailformat))
        return false;
    return true;
}

function reloadviews() {

    setInterval(function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("views").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","includes/getviews.php",true);
        xmlhttp.send();
    },1000);
    
}