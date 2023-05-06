<html>
<head>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Caja de comentarios</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>

	function commentSubmit(){
		if(form1.comments.value == ''){ //Comprobar si se ha añadido comentario
			alert('Comentario vacío');
			return;
		}
		var comments = form1.comments.value;
		var xmlhttp = new XMLHttpRequest(); //http request instance
		
		xmlhttp.onreadystatechange = function(){ //Comprobar comentarios para cargar
			if(xmlhttp.readyState==4&&xmlhttp.status==200){
				document.getElementById('comment_logs').innerHTML = xmlhttp.responseText; //Mostrar comentarios
			}
		}
		xmlhttp.open('GET', 'includes/comment_box/insert.php?comments='+comments, true); //Abre y envia un peticion http
		xmlhttp.send();
	}
	
		$(document).ready(function(e) {
			$.ajaxSetup({cache:false});
			setInterval(function() {$('#comment_logs').load('includes/comment_box/load_comments.php');}, 2000);
		});
		
</script>
</head>
<body>
<div id="container">

	<br><br>
	<h1>Comentarios</h1>
	<br>
    <div class="comment_input">
        <form name="form1">
            <textarea name="comments" placeholder="Inserta un comentario..." style="height:100%;"></textarea></br></br>
            <a href="#" onClick="commentSubmit()" class="button">Publicar</a></br>
        </form>
    </div>
    <div id="comment_logs">
    	Cargando comentarios
    <div>
</div>
</body>
</html>