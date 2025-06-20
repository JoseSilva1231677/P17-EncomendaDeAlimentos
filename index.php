<!DOCTYPE html>
<html>
<head>
    <title>Restaurante</title>
    <link rel="stylesheet" type="text/css" href="styles/index.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <a href="login.html">Login</a>
            <a href="signup.html">Signup</a>
            <a href="carrinho.html">Carrinho</a>
        </div>

        <h1>Nome do Restaurante</h1>
        <div class="grelha">
            <?php
            // Connect to the SQLite database
            $db = new SQLite3('menus.db');
            
            // Query to get all menus
            $results = $db->query('SELECT * FROM Menus');
            
            // Loop through each menu and display it
            while ($row = $results->fetchArray()) {
                echo '
                <div class="menu">
                    <img src="images/provisorio.png" alt="' . htmlspecialchars($row['menu']) . '">
                    <h3>' . htmlspecialchars($row['menu']) . '</h3>
                    <p>' . htmlspecialchars($row['preco']) . ' €</p>
                </div>';
            }
            
            // Close the database connection
            $db->close();
            ?>
            
            <div class="button-container" id="actionButtonContainer" style="display:none;">
                <a href="carrinho.html" id="actionButton">Adicionar ao carrinho</a>
            </div>
            <div class="button-container">
                <a href="gestao.php">Gestão</a>  
            </div>
        </div>
        
        <div class="Quem somos">
            <h2>Quem somos</h2>
            <h3>Descrição do restaurante</h3>
            <h3>Contactos: +351 911 111 111</h3>
            <h3>restaurante@gmail.com</h3>
        </div>
        
        <div id="carrinho">
            <!-- O carrinho de compras será talvez inserido aqui -->
        </div>
    </div>
</body>
</html>