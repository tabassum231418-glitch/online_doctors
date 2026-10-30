<?php
require_once 'config/db.php'; if(session_status()===PHP_SESSION_NONE) session_start();
$error=''; 
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $phone=trim($_POST['phone']??''); $pass=$_POST['password']??'';
  if($name===''||!filter_var($email,FILTER_VALIDATE_EMAIL)||$phone===''||strlen($pass)<8){$error='Enter valid details. Password must contain at least 8 characters.';}
  else{
    try{$stmt=$pdo->prepare("INSERT INTO users(name,email,phone,password) VALUES(?,?,?,?)");$stmt->execute([$name,$email,$phone,password_hash($pass,PASSWORD_DEFAULT)]);header('Location: login.php?registered=1');exit;}
    catch(PDOException $e){$error='This email may already be registered.';}
  }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Register</title><link rel="stylesheet" href="assets/style.css"></head><body><?php include 'includes/header.php'; ?><main class="container"><form class="form-box" method="post"><h2>Create Patient Account</h2><?php if($error):?><div class="alert error"><?=htmlspecialchars($error)?></div><?php endif;?><div class="form-group"><label>Full Name</label><input name="name" required></div><div class="form-group"><label>Email</label><input type="email" name="email" required></div><div class="form-group"><label>Phone</label><input name="phone" required></div><div class="form-group"><label>Password (minimum 8 characters)</label><input type="password" name="password" minlength="8" required></div><button class="btn">Register</button><p>Already registered? <a href="login.php">Login</a></p></form></main><?php include 'includes/footer.php'; ?></body></html>
