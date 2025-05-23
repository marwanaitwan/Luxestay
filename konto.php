<?php
include 'mydb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

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