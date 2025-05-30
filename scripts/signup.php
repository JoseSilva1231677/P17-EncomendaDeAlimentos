<?php
// Conectar à base de dados SQLite3
$db = new SQLite3('BDsignup.db');

// Cria tabela
$db->exec("CREATE TABLE IF NOT EXISTS Utilizadores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)");

// POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';

    // Validação
    if (empty($email) || empty($senha)) {
        echo "Email e password são obrigatórios.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit;
    }

    // Verificar email
    $stmt = $db->prepare("SELECT id FROM Utilizadores WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        echo "Este email já está registado.";
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir novo utilizador
    $stmt = $db->prepare("INSERT INTO Utilizadores (email, password) VALUES (:email, :password)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $senhaHash, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "Registo efetuado com sucesso!";
    } else {
        echo "Erro ao registar utilizador.";
    }
}

// Mostrar todos os utilizadores
echo "<h3>Utilizadores registados</h3>";
$sql = "SELECT id, email FROM Utilizadores";
$result = $db->query($sql);

echo "<table border='1'>\n<tr><th>ID</th><th>Email</th></tr>\n";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['email'] . "</td></tr>\n";
}
echo "</table>";

unset($db); // Fechar ligação
?>

<!-- Formulário HTML -->
<h2>Registo</h2>
<form method="POST" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registar</button>
</form>




