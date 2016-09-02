<form method="post">
	<textarea rows="6" cols="200" name="texto" id="texto">
<?=($_POST) ? $_POST['texto'] : "######  ######   #####  ######  ######  
  ##    #       #         ##    #       
  ##    #####    ####     ##    #####   
  ##    #            #    ##    #       
  ##    ######  #####     ##    ######" ?>  
	</textarea><br/>
	<input type="submit" value="Ler!" />
</form>
<pre>
<?php
//ini_set("display_errors", 'On');
if($_POST) {
	include 'funcoes.php';
	
	$texto = $_POST['texto'];
	
	$entradas = lerEntrada($texto);
	$ann = fann_create_from_file('banner2.net');
	
	echo "<h1>";
	
	foreach ($entradas as $entrada) {
		$saida = fann_run($ann, $entrada);   // Array de Floats
		$saida = array_map('round', $saida); // Array de Inteiros
		$saida = implode("", $saida);        // String com número binário
		$saida = bindec($saida);             // Numero decimal inteiro
		
		$dec .= $saida." "; 
		
		// Definindo letra
		switch ($saida) {
			case 26:
				$saida = " ";
				break;
			case 27:
				$saida = "Ç";
				break;
			default:
				$saida = chr(65+$saida);
				break;
			
		}
		
		echo $saida;
	}
	
	echo "</h1>";
	echo $dec;
}
?>
