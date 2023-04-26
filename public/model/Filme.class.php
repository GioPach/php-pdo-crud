<?php
include_once '../conexao.php';

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
}