<?php
require_once 'config/db.php'; require_once 'includes/auth.php'; require_login();
$doctorId=(int)($_GET['doctor_id']??$_POST['doctor_id']??0);$stmt=$pdo->prepare("SELECT * FROM doctors WHERE id=?");$stmt->execute([$doctorId]);$doctor=$stmt->fetch();$error='';
if(!$doctor){http_response_code(404);exit('Doctor not found.');}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $date=$_POST['appointment_date']??'';$time=$_POST['appointment_time']??'';$reason=trim($_POST['reason']??'');
 if(!$date||!$time||$date<date('Y-m-d')){$error='Please choose a valid future date and time.';}
 else{$stmt=$pdo->prepare("INSERT INTO appointments(user_id,doctor_id,appointment_date,appointment_time,reason) VALUES(?,?,?,?,?)");$stmt->execute([$_SESSION['user_id'],$doctorId,$date,$time,$reason]);header('Location: my_appointments.php?booked=1');exit;}
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Book Appointment</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'includes/header.php'; ?><main class="container"><form class="form-box" method="post"><h2>Book Appointment</h2><p><b><?=htmlspecialchars($doctor['name'])?></b> — <?=htmlspecialchars($doctor['specialization'])?></p><p>Fee: ৳<?=htmlspecialchars($doctor['fee'])?></p><?php if($error):?><div class="alert error"><?=htmlspecialchars($error)?></div><?php endif;?><input type="hidden" name="doctor_id" value="<?=$doctorId?>"><div class="form-group"><label>Appointment Date</label><input type="date" name="appointment_date" min="<?=date('Y-m-d')?>" required></div><div class="form-group"><label>Appointment Time</label><input type="time" name="appointment_time" required></div><div class="form-group"><label>Reason for visit</label><textarea name="reason" rows="4" placeholder="Briefly describe your reason"></textarea></div><button class="btn">Confirm Booking</button></form></main><?php include 'includes/footer.php'; ?></body></html>
