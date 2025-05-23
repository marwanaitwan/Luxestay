<?php
session_start();
include 'mydb.php';

// Kolla om användaren är inloggad, annars skicka till login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Variabel för att visa lyckat-meddelande efter skickad ticket
$success = false;

// När formuläret skickas in
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    // Förbered och kör SQL-frågan för att spara ticketen
    $stmt = $conn->prepare("INSERT INTO tickets (user_id, subject, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $subject, $message);
    $stmt->execute();

    // Redirecta för att undvika att form skickas flera gånger vid reload
    header("Location: tickets.php?sent=1");
    exit();
}

// Om URL:en har sent=1 betyder det att ticket skickades
if (isset($_GET['sent'])) {
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Support - LuxeStay</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Enkel styling */
        body { font-family: Arial, sans-serif; background: #f3f3f3; margin: 0; padding: 0; }
        header { background: #1c1c1c; color: white; padding: 15px 30px; display: flex; align-items: center; }
        header a { color: white; text-decoration: none; font-size: 24px; font-weight: bold; }
        main { max-width: 600px; margin: 40px auto; padding: 25px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form label { font-weight: bold; }
        input[type="text"], textarea {
            width: 100%; padding: 10px; margin: 6px 0 16px; border: 1px solid #ccc; border-radius: 6px; resize: none;
        }
        button {
            background: #1c1c1c; color: white; padding: 10px 18px; border: none; border-radius: 6px; cursor: pointer;
        }
        .success-message { color: green; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>

<header>
    <!-- Loggan är en länk till startsidan -->
    <a href="hemsida.php">LuxeStay</a>
</header>

<main>
    <h2>Skicka en supportticket</h2>

    <?php if ($success): ?>
        <!-- Visa tack-meddelande om ticket skickades -->
        <p class="success-message">Tack! Din ticket är skickad.</p>
    <?php else: ?>
        <!-- Ticketformulär -->
        <form method="POST" action="">
            <label for="subject">Ämne:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Meddelande:</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Skicka Ticket</button>
        </form>
    <?php endif; ?>
</main>

</body>
</html>
