<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<header class="topbar">
  <a class="brand" href="index.php">Care<span>Point</span></a>
  <nav>
    <a href="index.php">Home</a>
    <a href="doctors.php">Doctors</a>
    <?php if (!empty($_SESSION['user_id'])): ?>
      <a href="my_appointments.php">My Appointments</a>
      <?php if (($_SESSION['role'] ?? '') === 'admin'): ?><a href="admin.php">Admin</a><?php endif; ?>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a class="nav-button" href="register.php">Register</a>
    <?php endif; ?>
  </nav>
</header>
