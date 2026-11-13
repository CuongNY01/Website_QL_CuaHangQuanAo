<?php  
session_start();
unset($_SESSION['name']);
unset($_SESSION['username']);
unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['avata']);
unset($_SESSION['password']);
header("location: ../controller/index.php?act=login");
exit;
?>
