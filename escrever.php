<form method="post">
	<input name="texto" id="texto" />
	<input type="submit" value="Escrever!" />
</form>

<?php
if($_POST) {
	include 'funcoes.php';
	
	echo "<pre>".escrever($_POST['texto'], 'letras.txt')."</pre>";
}
?>