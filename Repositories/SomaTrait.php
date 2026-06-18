<?php 

trait SomaTrait
{
    private PDO $conn;
    
    public function executarSoma(string $sql, array $params = []): float
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $linha = $stmt->fetch();
        return (float) ($linha['total'] ?? 0);
    }
}

?>