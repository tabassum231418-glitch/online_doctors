<?php
require_once 'config/db.php'; if(session_status()===PHP_SESSION_NONE) session_start(); $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=trim($_POST['email']??'');$password=$_POST['password']??'';
 $stmt=$pdo->prepare("SELECT id,name,password,role FROM users WHERE email=?");$stmt->execute([$email]);$user=$stmt->fetch();
 if($user && password_verify($password,$user['password'])){session_regenerate_id(true);$_SESSION['user_id']=$user['id'];$_SESSION['user_name']=$user['name'];$_SESSION['role']=$user['role'];header('Location: '.($user['role']==='admin'?'admin.php':'my_appointments.php'));exit;}
 $error='Invalid email or password.';
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'includes/header.php'; ?><main class="container"><form class="form-box" method="post"><h2>Login</h2><?php if(isset($_GET['registered'])):?><div class="alert">Account created. Please log in.</div><?php endif;?><?php if($error):?><div class="alert error"><?=htmlspecialchars($error)?></div><?php endif;?><div class="form-group"><label>Email</label><input type="email" name="email" required></div><div class="form-group"><label>Password</label><input type="password" name="password" required></div><button class="btn">Login</button><p>New patient? <a href="register.php">Create account</a></p></form></main><?php include 'includes/footer.php'; ?></body></html>
