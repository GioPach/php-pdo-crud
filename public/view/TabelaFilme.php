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
    <link rel="stylesheet" href="./../styles/tabela.css">
    <link rel="stylesheet" href="./../styles/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>
    <main>

        <section class="flex-section gap-3">
            <h1 class="filmes-title">Filmes</h1>


            <?php if (empty($filmes)) { ?>
                <h3 class="msg-empty">Nenhum filme cadastrado...</h3>
            <?php } else { ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Diretor</th>
                            <th class="text-center">Elenco</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($filmes as $filme) { ?>
                            <tr>
                                <td class="text-center">
                                    <!-- <\?= é uma junção de php echo -->
                                    <?= $filme->getId() ?>
                                </td>
                                <td class="text-center">
                                    <?= $filme->getNome() ?>
                                </td>
                                <td class="text-center">
                                    <?= $filme->getDescricao() ?>
                                </td>
                                <td class="text-center">
                                    <?= $filme->getDiretor() ?>
                                </td>
                                <td class="text-center">
                                    <?= $filme->getElenco() ?>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="../controller/FilmeController.php?action=deletar&id=<?= $filme->getId() ?>"
                                        class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?> <!-- fechar foreach -->

                    </tbody>

                </table>
            <?php } ?>

        </section>

    </main>

</body>

</html>