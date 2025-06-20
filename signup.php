<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Abrir ligação à base de dados no mesmo diretório
$db = new SQLite3(__DIR__ . '/registoutilizadores.db');

// Criar a tabela se ainda não existir
$db->exec("CREATE TABLE IF NOT EXISTS utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE,
    password TEXT
)");

// Verificar se foi feito um POST (submissão do formulário)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Inserir dados com segurança (evita SQL injection)
    $stmt = $db->prepare("INSERT INTO utilizadores (email, password) VALUES (:email, :password)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    // Tentar executar o comando
    if ($stmt->execute()) {
        echo "Utilizador registado com sucesso!";
    } else {
        echo "Erro: Este email já está registado.";
    }
}
?>
