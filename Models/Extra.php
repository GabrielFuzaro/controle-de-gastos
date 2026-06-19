<?php 

class Extra{
    public string $descricao;
    public float $valor;
    public string $data_entrada;

    public function __construct(string $descricao ,float $valor, string $data_entrada){
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->data_entrada = $data_entrada;
    }
}

