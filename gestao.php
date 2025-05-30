<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Gestão</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      margin: 20px 0;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <main>
    <h1>Painel de Gestão</h1>

    <!-- Form to add new menu -->
    <section>
      <h2>Adicionar Menu</h2>
      <form method="POST" action="">
        <input type="text" name="new_menu" placeholder="Nome do menu" required>
        <input type="number" name="new_price" placeholder="Preço (€)" step="0.01" required>
        <button type="submit" name="add_menu">Adicionar</button>
      </form>
    </section>

    <!-- Form to delete menu -->
    <section>
      <h2>Remover Menu</h2>
      <form method="POST" action="">
        <input type="number" name="delete_id" placeholder="ID do menu" required>
        <button type="submit" name="delete_menu">Remover</button>
      </form>
    </section>

    <!-- Menu list display -->
    <section>
      <h2>Menus Disponíveis</h2>
      <?php
        // Include your database code
        include 'scripts/gestao.php';
        
        // Handle form submissions
        if (isset($_POST['add_menu'])) {
            $db = new SQLite3('menus.db');
            $menu = $_POST['new_menu'];
            $price = $_POST['new_price'];
            $db->exec("INSERT INTO Menus(menu, preco) VALUES('$menu', $price)");
            unset($db);
            header("Location: gestao.php");
            exit();
        }
        
        if (isset($_POST['delete_menu'])) {
            $db = new SQLite3('menus.db');
            $id = $_POST['delete_id'];
            $db->exec("DELETE FROM Menus WHERE id = $id");
            unset($db);
            header("Location: gestao.php");
            exit();
        }
      ?>
    </section>

    <a href="index.html">Voltar à página inicial</a>
  </main>
</body>
</html>