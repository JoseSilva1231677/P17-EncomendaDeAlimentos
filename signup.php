<?php
// Criar a base de dados e a tabela (só na primeira vez)
$db = new SQLite3('database.db');
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    last_access TEXT
)");

// Se vier dados do formulário (POST), tenta registar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "Utilizador registado com sucesso!";
    } else {
        echo "Erro: Este email já está registado.";
    }
}
?>