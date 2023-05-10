<?php
include 'Video.class.php';
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

        // echo $alteredRows > 0 ? 'Vídeo '$this->nome' inserido' : 'Falha ao inserir';
        $alteredRows = $stmt->rowCount();
        return $alteredRows > 0;
    }

    public static function deletar($id)
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('DELETE FROM filme WHERE id = :id');
        $stmt->execute(
            [
                ':id' => $id
            ]
        );
        $alteredRows = $stmt->rowCount();
        return $alteredRows > 0;
    }

    //* Performático
    //* Mais útil para páginas de relatório rápidas
    //* não muito útil para CRUDs
    public static function echoAll()
    {
        $pdo = conexao();
        foreach ($pdo->query('SELECT id, nome, diretor, elenco FROM filme') as $linha) {
            echo 'ID: ' . $linha['id'] . '<br />';
            echo 'Nome: ' . $linha['nome'] . '<br />';
            echo 'Diretor: ' . $linha['diretor'] . '<br />';
            echo 'Elenco: ' . $linha['elenco'] . '<br /><br />';
        }
    }

    public static function getAll()
    {
        $pdo = conexao();
        $lista = [];
        foreach ($pdo->query('SELECT * FROM filme') as $linha) {
            $filme = new Filme();
            $filme->setId($linha['id']);
            $filme->setNome($linha['nome']);
            $filme->setDescricao($linha['descricao']);
            $filme->setDiretor($linha['diretor']);
            $filme->setElenco($linha['elenco']);
            $lista[] = $filme;
        }
        return $lista;
    }


}

?>