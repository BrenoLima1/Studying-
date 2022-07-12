<?php

$argc = $_SERVER['argc'];
$argv = $_SERVER['argv'];

if($argc != 2){
    die("Passe 1 argumento!");
}

if(empty($argv[1])){
    die ( 'Não há valores para calcular média!' );
}

function changeToInt($numeros){
    $numerosInteiros = array();
    foreach($numeros as $n){
        $numerosInteiros []= (int)$n; 
    }
    return $numerosInteiros;
}

function somarArray(array $numeros){
    return array_sum($numeros);
}

function verificarNumeros(array $numeros){
    foreach($numeros as $numero){
        if(!is_numeric($numero)){
            die("Apenas números são aceitos!");
        }   
    }
}

$numeros = explode(',', $argv[1]);
verificarNumeros($numeros);
$numerosInteiros = changeToInt($numeros);
$somaValores = somarArray($numerosInteiros);
$media = $somaValores / count($numerosInteiros);

echo $media;

?>