<?php
function escrever($string, $arquivo) {
    $arrPadroes = file($arquivo);
	$array = str_split($string);
	foreach ($array as $letra) {
		
		switch ($letra) {
			case " ":
				$num = 26;
				break;
			case "Ç":
				$num = 27;
				break;
			default:
				$num = ord($letra)-65;
				break;
		}

		for($i = 0; $i < 5; $i++) {
			$banner[$i] .= str_replace("\n", "  ", $arrPadroes[$num*6+$i]);
		}
	}

	return implode("\n", $banner);
}
function lerPadroes($arquivo) {
    $arrPadroes = file($arquivo);
    
    $chars = array();
    $n     = 0;
	
    foreach($arrPadroes as $k => $linha) {
        if($k%6 == 5) {
            $saida[$n][0] = $chars;
            $saida[$n][1] = str_split(str_pad(decbin($n), 5, "0", STR_PAD_LEFT));
            
            $chars = array();
            $n++;
            continue;
        }
        $linha = str_replace("\n", "", $linha);
        $linha = str_replace(" " ,  0, $linha);
        $linha = str_replace("#" ,  1, $linha);

        $chars = array_merge($chars, str_split($linha));
    }
    
    return $saida;
}

function gerarArquivoPadroes($nomeArquivo, $array) {
    $totalAmostras = count($array);
    $totalEntradas = count($array[0][0]);
    $totalSaidas = count($array[0][1]);
    $dados = $totalAmostras." ".$totalEntradas." ".$totalSaidas."\n";

    foreach($array as $elem) {
        $dados .= implode(" ", $elem[0])."\n";
        $dados .= implode(" ", $elem[1])."\n";
    }
    file_put_contents($nomeArquivo, $dados);
}

function lerEntrada($string) {
	
	$arrEntrada = explode("\r\n", $string);
    
	for($i = 0; $i < 5; $i++) {
        $linha = $arrEntrada[$i];
        $linha = str_replace(" " ,  0, $linha);
        $linha = str_replace("#" ,  1, $linha);
        $linha = str_split($linha, 8);
        
        $linhas[$i] = $linha;
    }
    
    foreach ($linhas as $linha) {
    	for($i = 0; $i < count($linha); $i++) {
    		$letras[$i] .= substr($linha[$i], 0, 6);
    	}
    }
    
    $letras = array_map('str_split', $letras);
    return $letras;
}
