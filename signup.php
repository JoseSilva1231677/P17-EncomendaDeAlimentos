<?php
$db = new SQLite3('registoutilizadores.db');

 // criação da tabela utilizadores
 $db->exec("CREATE TABLE utilizadores(id INTEGER PRIMARY KEY, email TEXT, password TEXT)"); //(1)
 $db->exec("INSERT INTO utilizadores(email, password) VALUES('user1@example.com', 'password1')"); //(2)
 echo "<h3>Tabela de utilizadores </h3>";
 $sqlvar = "select * from utilizadores ;";

 $result = $db->query($sqlvar); //(3)
 echo “<table>\n<th> Id </th><th> email </th><th> password </th>\n”;
 while ($row = $result->fetchArray(SQLITE3_ASSOC)) //(4)
 {
 echo ‘<tr><td>’ . $row['id'] . '</td><td>' . $row['email'] . '</td><td>' . $row['password']
 . “</td></tr>\n”;
 }
 echo ‘</table>’;
 unset($db);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("INSERT INTO utilizadores (email, password) VALUES (:email, :password)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "Utilizador registado com sucesso!";
    } else {
        echo "Erro: Este email já está registado.";
    }
}
?>