<?php

include "../model/Filme.class.php";

// function printFilme(Filme $filme)
// {
//     return '<p>Nome: ' . $filme->getNome() . '</p>'
//         . '<p>Descrição: ' . $filme->getDescricao() . '</p>'
//         . '<p>Diretor: ' . $filme->getDiretor() . '</p>'
//         . '<p>Elenco: <' . $filme->getElenco() . '/p>';
// }
// function mensagemErroFilme($filme)
// {
//     return '<h3 style="color: #FF0000;">Erro '
//         . 'ao cadastrar Filme!</h3>'
//         . printFilme($filme);
// }

// function mensagemSucessoFilme($filme)
// {
//     return '<h3 style="color: #4CAF50;">Sucesso '
//         . 'ao cadastrar Filme!</h3>'
//         . printFilme($filme);
// }

// function mensagemErro()
// {
//     return '<h3 style="color: #FF0000;">Envie todos os dados do filme!<h3>';
// }

function saveFilme()
{
    $filme = new Filme();
    $filme->setNome($_POST['nome']);
    $filme->setDescricao($_POST['descricao']);
    $filme->setDiretor($_POST['diretor']);
    $filme->setElenco($_POST['elenco']);

    if ($filme->save()) {
        return $filme;
        // return mensagemSucessoFilme($filme);
    }

    return new Filme();
    // return mensagemErroFilme($filme);

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
    isFilmeSet() && saveFilme();
    header("Location: ../view/TabelaFilme.php");
    // echo isFilmeSet() ? saveFilme() : mensagemErro();
} else if ($action == 'deletar') {

    //* $_REQUEST
    //     Note:
    // The variables in $_REQUEST are provided to the script via the GET, POST, and COOKIE 
    // input mechanisms and therefore could be modified by the remote user and cannot be trusted. 
    // The presence and order of variables listed in this array is defined according to the PHP 
    // request_order, and variables_order configuration directives.

    //?     Abrir no xampp_control Apache > Config > PHP(php.ini)
    //?     E=Envy, G=Get, P=Post, C=Cookie, S=Session
    //?     ; request_order                     ; variables_order    
    //?     ;   Default Value: None             ;   Default Value: "EGPCS"
    //?     ;   Development Value: "GP"         ;   Development Value: "GPCS"
    //?     ;   Production Value: "GP"          ;   Production Value: "GPCS" 
    //* Requisição: http://localhost/php-pdo-crud/public/controller/FilmeController.php?action=deletar&id=1

    Filme::deletar($_REQUEST['id']);
    header("Location: ../view/TabelaFilme.php");

} else if ($action == 'relatorio') {
    Filme::echoAll();
} else if ($action == 'getAll') {
    Filme::getAll();
}