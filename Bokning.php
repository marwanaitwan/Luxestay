<?php
session_start();
include 'mydb.php';

$bookingSuccess = false;
$errorMessage = '';

// Kolla om användaren är inloggad, annars skicka till login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Om bokningsformuläret skickas
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hämta bokningsdata från formuläret
    $room_number = $_POST['room_number'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $user_id = $_SESSION['user_id'];

    // Förbered och kör SQL för att lägga till bokningen
    $sql = "INSERT INTO bookings (user_id, room_number, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $room_number, $start_date, $end_date);

    if ($stmt->execute()) {
        $bookingSuccess = true; // Bokningen lyckades
    } else {
        $errorMessage = "Fel vid bokning: " . $stmt->error; // Visa fel
    }
}
?>


<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boka Rum - Luxestay</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
      <nav>
        <ul>
          <li><a href="hemsida.php"
          >Hem</a></li>
          <li><a href="Bokning.php">Bokning</a></li>
          <li><a href="#">Support</a></li>
        </ul>
        
      </nav>
      <div class="login-button">
        <a href="Login.php">Logga in</a>
      </div>
    </header>

<main class="booking-container">
    <h1>Boka Ditt Rum</h1>
    <form class="booking-form">
        <label for="room_number">Rumsnummer</label>
        <input type="number" id="room_number" name="room_number" required>

        <label for="start_date">Startdatum</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">Slutdatum</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit">Boka Nu</button>
    </form>
</main>

</body>

</html>


       