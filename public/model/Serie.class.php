<?php
include_once '../conexao.php';

class Serie
{
    private $episodios;
    private $temporadas;

    /**
     * @return mixed
     */
    public function getEpisodios()
    {
        return $this->episodios;
    }

    /**
     * @param mixed $episodios 
     * @return self
     */
    public function setEpisodios($episodios): self
    {
        $this->episodios = $episodios;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemporadas()
    {
        return $this->temporadas;
    }

    /**
     * @param mixed $temporadas 
     * @return self
     */
    public function setTemporadas($temporadas): self
    {
        $this->temporadas = $temporadas;
        return $this;
    }
}

?>