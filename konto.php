<?php
include 'mydb.php';

// Kolla om formuläret skickats
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    // Hasha lösenordet säkert innan databasen
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Förbered SQL för att skapa nytt konto
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    // Kör SQL och visa om det gick bra eller ej
    if ($stmt->execute()) {
        echo "Konto skapat! <a href='login.php'>Logga in här</a>";
    } else {
        echo "Fel: " . $stmt->error;
    }

    $stmt->close();
}
?>



<html lang="sv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skapa Konto</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
  <h1>Skapa Konto</h1>
  <form method="POST">
    <div class="input-group">
      <label for="username">Användarnamn</label>
      <input type="text" name="username" required>
    </div>
    <div class="input-group">
      <label for="password">Lösenord</label>
      <input type="password" name="password" required>
    </div>
    <button class="login-btn" type="submit">Skapa konto</button>
  </form>
</div>
</body>
</html>