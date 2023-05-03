<?php
include_once './../model/Filme.class.php';
$filmes = Filme::getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PachFlix - Tabela de Filmes</title>
    <link rel="stylesheet" href="../styles/tabela.css">
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <main>

        <section class="main-section">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Diretor</th>
                        <th>Elenco</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($filmes as $filme) { ?>
                        <tr>
                            <td>
                                <?= $filme->getId() ?>
                            </td>
                            <td>
                                <?= $filme->getNome() ?>
                            </td>
                            <td>
                                <?= $filme->getDescricao() ?>
                            </td>
                            <td>
                                <?= $filme->getDiretor() ?>
                            </td>
                            <td>
                                <?= $filme->getElenco() ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>

            </table>
        </section>

    </main>

</body>

</html>