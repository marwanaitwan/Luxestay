<?php
include 'mydb.php';

// Kolla först om kolumnen redan finns
$check = $conn->query("SHOW COLUMNS FROM users LIKE 'is_admin'");
if ($check->num_rows == 0) {
    // Lägg till kolumnen om den inte finns
    $sql = "ALTER TABLE users ADD COLUMN is_admin BOOLEAN DEFAULT FALSE";
    if ($conn->query($sql) === TRUE) {
        echo "✅ Kolumnen 'is_admin' har lagts till.<br>";
    } else {
        echo "❌ Fel vid skapande av kolumn: " . $conn->error . "<br>";
    }
} else {
    echo "ℹ️ Kolumnen 'is_admin' finns redan.<br>";
}

// Gör 'Alexander Nord' till admin
$update = $conn->query("UPDATE users SET is_admin = TRUE WHERE username = 'Alexander Nord'");
if ($update) {
    echo "✅ 'Alexander Nord' är nu admin.";
} else {
    echo "❌ Kunde inte uppdatera admin-status: " . $conn->error;
}

$conn->close();
?>

