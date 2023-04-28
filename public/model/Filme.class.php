<?php
include "Video.class.php";
include_once '../core/conexao.php';
class Filme extends Video
{
    private $diretor;
    private $elenco;

    /**
     * @return mixed
     */
    public function getDiretor()
    {
        return $this->diretor;
    }

    /**
     * @param mixed $diretor
     * @return self
     */
    public function setDiretor($diretor): self
    {
        $this->diretor = $diretor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getElenco()
    {
        return $this->elenco;
    }

    /**
     * @param mixed $elenco
     * @return self
     */
    public function setElenco($elenco): self
    {
        $this->elenco = $elenco;
        return $this;
    }


    public function save()
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('INSERT INTO filme (nome, descricao, diretor, elenco) VALUES(:nome, :descricao, :diretor, :elenco)');
        $stmt->execute(
            [
                ':nome' => $this->nome,
                ':descricao' => $this->descricao,
                ':diretor' => $this->diretor,
                ':elenco' => $this->elenco
            ]
        );

        $alteredRows = $stmt->rowCount();
        return $alteredRows > 0;
        // echo $alteredRows > 0 ? "Vídeo '$this->nome' inserido" : "Falha ao inserir";
    }
}

?>