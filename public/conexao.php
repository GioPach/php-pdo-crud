<?php

try {
  // conectar banco criado nophpmyadmin / root e senha vazia por padrão
  $pdo = new PDO('mysql:host=localhost;dbname=pachflix', 'root', '');

  // configurar interrupção do php quando gerar exceção (padrão só gera warning)
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('INSERT INTO filme (nome) VALUES(:nome)');

  $stmt->execute(
    [
      ':nome' => 'IT'
    ]
  );

  $alteredRows = $stmt->rowCount();
  $lastInsertedId = $pdo->lastInsertId();

  echo
    "<h2> Last id inserted: $lastInsertedId</h2>" .
    "<h3> Rows altered: $alteredRows</h3>";

} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

?>