<?php 

Interface RepositoryInterface{
    public function salvar(object $entidade): bool;
    public function listar(): array;
    public function buscarPorId(int $id): array|false;
    public function excluir(int $id): bool;
}

?>