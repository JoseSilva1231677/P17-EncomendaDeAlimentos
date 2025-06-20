<?php
session_start();
$carrinho = $_SESSION['carrinho'] ?? [];

if (empty($carrinho)) {
    echo "Carrinho vazio.";
    exit;
}

$total = 0;
foreach ($carrinho as $i) {
    // Simula preços
    $preco_unit = 10; 
    $total += $preco_unit * $i['qtd'];
}

try {
   $db = new PDO('sqlite:../db/encomendas.db');
    $sql = "CREATE TABLE IF NOT EXISTS encomendas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        itens TEXT,
        total REAL,
        datahora DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
     $db->exec($sql);

    // Insere a encomenda
    $stmt = $db->prepare("INSERT INTO encomendas (itens, total) VALUES (?, ?)");
    $stmt->execute([json_encode($carrinho), $total]);

    unset($_SESSION['carrinho']);  // Limpa o carrinho
    echo "Encomenda realizada com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
