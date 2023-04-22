
<div class="usernav">

<ul> <!-- Barra de opciones (Zona izquierda)-->
    <li><img width="40" height="40" src="data/images/logo.png" alt=""> <a href="home.php">Inicio</a></li><li><a href="profile.php">Perfil</a></li>
    
    </ul>
    <ul class="ul-right"> <!--  Barra de opciones (Zona derecha)-->
        <li><a href="logout.php">Cerrar sesión <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
  <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
  <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
</svg></a> </li>
    </ul>

</div>

<script>
function validateField(){
    var query = document.getElementById("query");
    var button = document.getElementById("querybutton");
    if(query.value == "") {
        query.placeholder = 'Type something!';
        return false;
    }
    return true;
}
</script>