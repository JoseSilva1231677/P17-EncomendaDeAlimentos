<?php
    $db = new SQLite3('menus.db');
    // criação da tabela Menus
    $db->exec("CREATE TABLE Menus(id INTEGER PRIMARY KEY, menu TEXT, preco INT)"); //(1)
    $db->exec("INSERT INTO Menus(menu, preco) VALUES('Menu1', 10)"); //(2)
    $db->exec("INSERT INTO Menus(menu, preco) VALUES('Menu2', 12)"); //(2)
    $db->exec("INSERT INTO Menus(menu, preco) VALUES('Menu3', 15)"); //(2)
    $db->exec("INSERT INTO Menus(menu, preco) VALUES('Menu4', 17)"); //(2)
    echo "<h3>Tabela de Menus </h3>";
    $sqlvar = "select * from Menus ;";
    $result = $db->query($sqlvar); //(3)
    echo "<table>\n<th> Id </th><th> Menu </th><th> Preço </th>\n";
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) //(4)
    {
    echo '<tr><td>'. $row['id'] . '</td><td>' . $row['menu'] . '</td><td>' . $row['preco'] . "</td></tr>\n";
    }
    echo '</table>';
    unset($db);
?>