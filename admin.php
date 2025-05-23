<?php
session_start();
include 'mydb.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    die("Du har inte behörighet.");
}

$result = $conn->query("SELECT t.id, u.username, t.subject, t.message, t.status 
                        FROM tickets t 
                        JOIN users u ON t.user_id = u.id");

while ($row = $result->fetch_assoc()) {
    echo "<div><strong>{$row['username']}</strong> - {$row['subject']} - Status: {$row['status']}<br>{$row['message']}<hr></div>";
}
?>

<html lang="sv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adminpanel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
  <h1>Inkommande Tickets</h1>
  <?php while($row = $result->fetch_assoc()): ?>
    <div style="background:#f0f0f0; padding:10px; margin-bottom:10px; border-radius:5px;">
      <strong><?= htmlspecialchars($row['username']) ?>:</strong>
      <p><?= htmlspecialchars($row['message']) ?></p>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>