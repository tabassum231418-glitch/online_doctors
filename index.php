<?php require_once 'config/db.php'; $doctors=$pdo->query("SELECT * FROM doctors ORDER BY id DESC LIMIT 3")->fetchAll(); ?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>CarePoint | Online Doctor Appointment</title><link rel="stylesheet" href="assets/style.css"></head><body>
<?php include 'includes/header.php'; ?>
<div class="container">
<section class="hero"><h1>Healthcare made easier.</h1><p>Find a doctor, choose a suitable time and request an appointment online. Manage your appointments from one simple dashboard.</p><a class="btn" href="doctors.php">Find a Doctor</a></section>
<h2 class="section-title">Why choose CarePoint?</h2><div class="cards"><div class="card"><h3>Find Specialists</h3><p>Explore doctors by their medical specialization.</p></div><div class="card"><h3>Easy Booking</h3><p>Request an appointment using a simple online form.</p></div><div class="card"><h3>Track Appointments</h3><p>View appointment details and current status.</p></div></div>
<h2 class="section-title">Featured Doctors</h2><div class="cards"><?php foreach($doctors as $d): ?><div class="card"><h3><?=htmlspecialchars($d['name'])?></h3><p><?=htmlspecialchars($d['specialization'])?></p><p>Consultation fee: ৳<?=htmlspecialchars($d['fee'])?></p><a class="small-btn" href="doctors.php">View details</a></div><?php endforeach; ?></div>
</div><?php include 'includes/footer.php'; ?></body></html>
