<?php
// Começa submissões de formulário no INÍCIO do ficheiro
// (Isto corrigiu o erro onde a ordem de menus estava com bugs na criação)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3('menus.db');
    
    if (isset($_POST['add_menu'])) {
        $menu = $_POST['new_menu'];
        $price = $_POST['new_price'];
        $db->exec("INSERT INTO Menus(menu, preco) VALUES('$menu', $price)");
    } 
    elseif (isset($_POST['delete_menu'])) {
        $id = $_POST['delete_id'];
        $db->exec("DELETE FROM Menus WHERE id = $id");
    }
    
    unset($db);
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to avoid resubmission
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
</head>
<body>
  <main>
    <h1>Painel de Gestão</h1>
    
    <!-- Formulários Ad/Rem Menus -->
    <section>
      <h2>Adicionar Menu</h2>
      <form method="POST" action="">
        <input type="text" name="new_menu" placeholder="Nome do menu" required>
        <input type="number" name="new_price" placeholder="Preço (€)" step="0.01" required>
        <button type="submit" name="add_menu">Adicionar</button>
      </form>
    </section>

    <section>
      <h2>Remover Menu</h2>
      <form method="POST" action="">
        <input type="number" name="delete_id" placeholder="ID do menu" required>
        <button type="submit" name="delete_menu">Remover</button>
      </form>
    </section>

    <!-- Lista dos menus disponíveis -->
    <section>
      <h2>Menus Disponíveis</h2>
      <?php include 'scripts/gestao.php'; ?>
    </section>

    <a href="index.html">Voltar à página inicial</a>
  </main>
</body>
</html>