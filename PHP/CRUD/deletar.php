<?php
if ( ! array_key_exists( 'id', $_GET ) ) {
    http_response_code( 400 ); // Bad Request
    die('Id não fornecido');
}
$id = $_GET[ 'id' ];
// echo $id;

$pdo = null;
try {
    $pdo = new PDO(
        'mysql:dbname=acme_2022_1;host=127.0.0.1',
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
    $ps = $pdo->prepare(
        'DELETE FROM contato WHERE id = :id' );
    $ps->execute( [ 'id' => $id ] );

    if ( $ps->rowCount() < 1 ) {
        http_response_code( 404 ); // Not Found
        die( 'Id não encontrado' );
    }
    header( 'Location: listagem.php' );

} catch ( PDOException $e ) {
    echo 'Erro: ', $e->getMessage(), '<br />';
}

?>