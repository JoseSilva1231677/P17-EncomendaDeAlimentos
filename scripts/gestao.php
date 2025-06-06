<?php
$db = new sqlite3('menus.db');

// Só cria tabela se ela não existir
$db->exec("
    CREATE TABLE IF NOT EXISTS Menus (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        menu TEXT NOT NULL,
        preco REAL NOT NULL
    )
");

// Procura query com os menus existentes na db
$result = $db->query("SELECT * FROM Menus");
echo '<table>';
echo '<tr><th>ID</th><th>Menu</th><th>Preço (€)</th></tr>';
while ($row = $result->fetchArray()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['menu']}</td><td>{$row['preco']}</td></tr>";
}
echo '</table>';
unset($db);
?>