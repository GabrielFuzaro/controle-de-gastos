<?php 

class Gasto{
    public string $descricao;
    public string $categoria;
    public float $valor;
    public string $data_gasto;

    public function __construct(string $descricao, string $categoria, float $valor ,string $data_gasto) {
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->valor = $valor;
        $this->data_gasto = $data_gasto;
    }
}

?>