<?php
session_start();
unset($_SESSION['LoginUserID']);
unset($_SESSION['LoginUser']);
unset($_SESSION['conn']);
session_destroy();
header("Location: login.php");
exit;
?>