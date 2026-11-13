<?php
session_start();
unset($_SESSION['idAdmin']);
unset($_SESSION['userAd']);
header("location: ../controller/indexAdmin.php");
exit;
?>
