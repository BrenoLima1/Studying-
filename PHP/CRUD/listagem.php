<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="cadastro.html" >Cadastrar</a>
    <h1>Contatos</h1>
    <table>
        <thead>
            <tr> <th>Id</th> <th>Nome</th> <th>Telefone</th> <th>Ação</th> </tr>
        </thead>
        <tbody>
            <?php
            $pdo = null;
            $contatos = [];
            try {
                $pdo = new PDO(
                    'mysql:dbname=acme_2022_1;host=127.0.0.1',
                    'root',
                    '',
                    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
                );
                $ps = $pdo->prepare( 'SELECT * FROM contato' );
                $ps->execute();
                $contatos = $ps->fetchAll( PDO::FETCH_ASSOC );
            } catch ( PDOException $e ) {
                echo 'Erro ao conectar: ', $e->getMessage(), '<br />';
            }
            // $contatos = [
            //     [ 'nome' => 'Ana', 'telefone' => '22334455' ],
            //     [ 'nome' => 'Bia', 'telefone' => '33445566' ],
            // ];
            foreach ( $contatos as $c ) {
                echo <<<HTML
                    <tr>
                        <td>${c['id']}</td>
                        <td>${c['nome']}</td>
                        <td>${c['telefone']}</td>
                        <td><a href="deletar.php?id=${c['id']}" >Deletar</a> </td>
                    </tr>
HTML;
            }
            ?>
        </tbody>
    </table>
</body>
</html>