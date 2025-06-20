<?php
session_start();

$item = $_POST['item'] ?? '';
$qtd = $_POST['qtd'] ?? 1;

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$_SESSION['carrinho'][] = [
    'item' => $item,
    'qtd' => (int)$qtd
];

header('Location: ver_carrinho.php');
exit;
?>
