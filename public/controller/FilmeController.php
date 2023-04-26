<?php

include "../model/Filme.class.php";

function saveFilme()
{
    $filme = new Filme();
    $filme->setNome($_POST['nome']);
    $filme->setDescricao($_POST['descricao']);
    $filme->setDiretor($_POST['diretor']);
    $filme->setElenco($_POST['elenco']);
    $filme->save();
}

function isFilmeSet()
{
    if (!isset($_POST['nome']) || $_POST['nome'] == "") {
        return false;
    }
    if (!isset($_POST['descricao']) || $_POST['descricao'] == "") {
        return false;
    }
    if (!isset($_POST['diretor']) || $_POST['diretor'] == "") {
        return false;
    }
    if (!isset($_POST['elenco']) || $_POST['elenco'] == "") {
        return false;
    }

    return true;
}

$action = $_GET['action'];
if ($action == 'cadastrar') {
    echo isFilmeSet() ? saveFilme() : '<h3 style="color: #FF0000;">Envie todos os dados do filme!<h3>';
}


?>