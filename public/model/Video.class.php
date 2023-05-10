<?php
include_once '../core/conexao.php';

class Video
{
    protected $id;
    protected $nome;
    protected $descricao;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $nome 
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

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
        $stmt = $pdo->prepare('INSERT INTO video (nome, descricao) VALUES(:nome, :descricao)');
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->execute();
        // $stmt->execute(
        //     [
        //         ':nome' => $this->nome
        //     ]
        // );
        // $alteredRows = $stmt->rowCount();
        // echo $alteredRows > 0 ? "Vídeo '$this->nome' inserido" : "Falha ao inserir";
    }
    public function update()
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('UPDATE video SET nome = :nome, descricao = :descricao WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->execute();
        // $stmt->execute(
        //     [
        //         ':nome' => $this->nome
        //     ]
        // );
        // $alteredRows = $stmt->rowCount();
        // echo $alteredRows > 0 ? "Vídeo '$this->nome' inserido" : "Falha ao inserir";
    }

}

?>