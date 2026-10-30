<?php
require_once 'config/db.php';require_once 'includes/auth.php';require_admin();
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['id']??0);$status=$_POST['status']??'';
 if(in_array($status,['Pending','Approved','Completed','Cancelled'],true)){$stmt=$pdo->prepare("UPDATE appointments SET status=? WHERE id=?");$stmt->execute([$status,$id]);}
 header('Location: admin.php');exit;
}
$appointments=$pdo->query("SELECT a.*,u.name AS patient_name,u.email,u.phone,d.name AS doctor_name FROM appointments a JOIN users u ON a.user_id=u.id JOIN doctors d ON a.doctor_id=d.id ORDER BY a.created_at DESC")->fetchAll();
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Dashboard</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'includes/header.php'; ?><main class="container"><h1>Admin Dashboard</h1><p class="muted">Review appointment requests and update their status.</p><div class="table-wrap"><table><tr><th>Patient</th><th>Contact</th><th>Doctor</th><th>Date</th><th>Time</th><th>Reason</th><th>Status</th><th>Update</th></tr><?php foreach($appointments as $a):?><tr><td><?=htmlspecialchars($a['patient_name'])?></td><td><?=htmlspecialchars($a['email'].' / '.$a['phone'])?></td><td><?=htmlspecialchars($a['doctor_name'])?></td><td><?=htmlspecialchars($a['appointment_date'])?></td><td><?=htmlspecialchars(substr($a['appointment_time'],0,5))?></td><td><?=htmlspecialchars($a['reason']??'')?></td><td><?=htmlspecialchars($a['status'])?></td><td><form method="post"><input type="hidden" name="id" value="<?=$a['id']?>"><select name="status"><option>Pending</option><option>Approved</option><option>Completed</option><option>Cancelled</option></select><button class="small-btn">Save</button></form></td></tr><?php endforeach;?></table></div></main><?php include 'includes/footer.php'; ?></body></html>
