<?php
include_once '../conexao.php';

class Video
{
    private $nome;
    private $descricao;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome 
     * @return self
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao 
     * @return self
     */
    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function save()
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('INSERT INTO filme (nome) VALUES(:nome)');
        $stmt->execute(
            [
                ':nome' => $this->nome
            ]
        );

    }

}

$video = new Video();