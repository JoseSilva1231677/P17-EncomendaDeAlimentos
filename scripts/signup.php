<?php
// BD CONFIGURAR
$host = 'localhost';
$dbname = 'BDsignup';         // Substituir pelo nome da sua base de dados
$user = 'root';               // Substituir pelo utilizador da BD
$password = '';               // Substituir pela password da BD

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de ligação à base de dados: " . $e->getMessage());
}

// FORMULARIO
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';

    // Validar
    if (empty($email) || empty($senha)) {
        echo "Email e password são obrigatórios.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit;
    }

    // Verificar se o email já existe
    $stmt = $pdo->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "Este email já está registado.";
        exit;
    }

    // Hash da password
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserção
    $stmt = $pdo->prepare("INSERT INTO utilizadores (email, password) VALUES (?, ?)");

    if ($stmt->execute([$email, $senhaHash])) {
        echo "Registo efetuado com sucesso!";
    } else {
        echo "Erro ao registar utilizador.";
    }
} else {
    // Formulário simples para teste
    ?>
    <h2>Registo de Utilizador</h2>
    <form method="POST" action="signup.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Registar</button>
    </form>
    <?php
    
}


$db = new SQLite3('BDsignup.db');

 // criação da tabela Utilizadores
 $db->exec("CREATE TABLE Utilizadores (id INTEGER PRIMARY KEY, email TEXT)"); //(1)
 $db->exec("INSERT INTO Utilizadores(email) VALUES('ola@gmail.com')"); //(2)
 echo "<h3>Tabela de Utilizadores </h3>";
 $sqlvar = "select * from Utilizadores ;";

 $result = $db->query($sqlvar); //(3)
 echo “<table>\n<th> Id </th><th> email </th>\n”;
 while ($row = $result->fetchArray(SQLITE3_ASSOC)) //(4)
 {
 echo ‘<tr><td>’ . $row['id'] . '</td><td>' . $row['email'] . '</td></tr>\n’;
 }
 echo ‘</table>’;
 unset($db);
?>




