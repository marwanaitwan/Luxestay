<?php
include 'mydb.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password, $is_admin);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $is_admin;
            header("Location: hemsida.php");
            exit();
        } else {
            echo "Fel lösenord.";
        }
    } else {
        echo "Användaren finns inte.";
    }
}
?>

<html lang="sv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logga in</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
  <h1>Logga in</h1>
  <form method="POST">
    <div class="input-group">
      <label for="username">Användarnamn</label>
      <input type="text" name="username" required>
    </div>
    <div class="input-group">
      <label for="password">Lösenord</label>
      <input type="password" name="password" required>
    </div>
    <button class="login-btn" type="submit">Logga in</button>
  </form>
</div>
</body>
</html>
