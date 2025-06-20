<?php
session_start();
$carrinho = $_SESSION['carrinho'] ?? [];

if (empty($carrinho)) {
    echo "Carrinho vazio.";
    exit;
}

echo "<h2>Itens no carrinho:</h2><ul>";
foreach ($carrinho as $i) {
    echo "<li>{$i['item']} - Quantidade: {$i['qtd']}</li>";
}
echo "</ul>";

echo '<form action="checkout.php" method="post">';
echo '<button type="submit">Finalizar compra</button>';
echo '</form>';
?>
