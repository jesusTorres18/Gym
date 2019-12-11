<?php
include 'functions.php';
$_SESSION = array();
session_unset();
unset($_SESSION['Username']);
unset($_SESSION['Role']);
unset($_SESSION['CoachID']);
unset($_SESSION['JudgeID']);
session_destroy();

header("location:login.php");

exit;
?>
