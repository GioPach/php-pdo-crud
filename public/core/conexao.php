<?php
function conexao()
{
  // PDO = PHP Database Object
  $pdo = null;
  try {
    // conectar banco criado no phpmyadmin / root e senha vazia por padrão
    $pdo = new PDO('mysql:host=localhost;dbname=pachflix;charset=utf8', 'root', '');

    // configurar interrupção do php quando gerar exceção (padrão só gera warning)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;

  } catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
  }
}

?>