<?php

include "../model/Filme.class.php";

function printFilme(Filme $filme) {
return  '<p>Nome: ' . $filme->getNome() . '</p>'
. '<p>Descrição: ' . $filme->getDescricao() . '</p>'
. '<p>Diretor: ' . $filme->getDiretor() . '</p>'
. '<p>Elenco: <' . $filme->getElenco() . '/p>';
}
function mensagemErroFilme($filme) {
    return '<h3 style="color: #FF0000;">Erro '
    . 'ao cadastrar Filme!</h3>'
    . printFilme($filme);
}

function mensagemSucessoFilme($filme) {
    return '<h3 style="color: #4CAF50;">Sucesso '
    . 'ao cadastrar Filme!</h3>'
    . printFilme($filme);
}

function mensagemErro() {
    return '<h3 style="color: #FF0000;">Envie todos os dados do filme!<h3>';
}

function saveFilme()
{
    $filme = new Filme();
    $filme->setNome($_POST['nome']);
    $filme->setDescricao($_POST['descricao']);
    $filme->setDiretor($_POST['diretor']);
    $filme->setElenco($_POST['elenco']);

    if($filme->save()) {
        return mensagemSucessoFilme($filme);
    } else {
        return mensagemErroFilme($filme);
    }

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
    echo isFilmeSet() ? saveFilme() : mensagemErro();
}
