<pre>
<?php
ini_set("display_errors", 'On');
include 'funcoes.php';

$nomeArquivoDados = "letras.data";

$ann     = fann_create_standard(2, 30, 5);
$padroes = lerPadroes("letras.txt");
gerarArquivoPadroes($nomeArquivoDados, $padroes);

fann_train_on_file($ann,
           $nomeArquivoDados,
           100000,
           0.00001,
           100);

fann_save($ann, 'letras.net');
