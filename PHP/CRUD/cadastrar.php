<?php
$nome = $_POST[ 'nome' ];
$telefone = $_POST[ 'telefone' ];

$pdo = null;
try {
    $pdo = new PDO(
        'mysql:dbname=acme_2022_1;host=127.0.0.1',
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
    $ps = $pdo->prepare(
        'INSERT INTO contato ( nome, telefone ) VALUES ( :n, :t )' );
    $ps->execute( [ 'n' => $nome, 't' => $telefone ] );

    header( 'Location: listagem.php' );


} catch ( PDOException $e ) {
    echo 'Erro: ', $e->getMessage(), '<br />';
}

?>