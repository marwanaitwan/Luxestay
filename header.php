<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header style="background-color: #1c1c1c; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <a href="hemsida.php" style="color: white; text-decoration: none; font-size: 24px; font-weight: bold;">LuxeStay</a>
    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="logout.php" method="post" style="display: inline;">
                <button type="submit" style="background-color: transparent; color: white; border: none; font-size: 16px; cursor: pointer;">Logga ut</button>
            </form>
        <?php else: ?>
            <a href="login.php" style="color: white; margin-right: 15px; text-decoration: none;">Logga in</a>
            <a href="konto.php" style="color: white; text-decoration: none;">Skapa konto</a>
        <?php endif; ?>
    </nav>
</header>
