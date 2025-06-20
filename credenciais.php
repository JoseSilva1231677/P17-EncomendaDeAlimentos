<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3(__DIR__ . '/registoutilizadores.db');

// Receber dados do formulário
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Procurar utilizador com esse email e password
$stmt = $db->prepare("SELECT * FROM utilizadores WHERE email = :email AND password = :password");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':password', $password, SQLITE3_TEXT);
$result = $stmt->execute();

// Verifica se encontrou algum registo
if ($result->fetchArray()) {
    echo "<h2>Login realizado com sucesso!</h2>";
    echo "<a href='index.php'><button>Voltar à página inicial </button></a>";
 // Aqui poderias redirecionar para a área privada com: header("Location: area_privada.php");
} else {
    echo "Email ou password inválidos.";
}
?>
