<?php

function testarInsertFilme()
{
    $pdo = conexao();
    $stmt = $pdo->prepare('INSERT INTO filme (nome) VALUES(:nome)');
    $stmt->execute(
        [
            ':nome' => 'Star Wars'
        ]
    );
    $alteredRows = $stmt->rowCount();
    $lastInsertedId = $pdo->lastInsertId();
    echo
        "<h2> Last id inserted: $lastInsertedId</h2>" .
        "<h3> Rows altered: $alteredRows</h3>";

}

function testarInsertVideo()
{
    $video = new Video();
    $video->setNome('Gol de falta');
    $video->setDescricao('Gol de falta do Bruxo');
    $video->save();
}

echo "ola";