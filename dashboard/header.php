<?php 
session_start();
require_once '../dynamics/dynamism.php';
require_once '../constants/conn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRICOL.COM</title>
    <link rel="stylesheet" href="../CSS_FILES/style.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="shortcut icon" href="../IMAGES/orie.png" type="image/x-icon">
</head>
<body>

<nav>
    <div class="logo">
      <a style="text-decoration: none;" href="index.php"> <h1> fricol </h1> </a>
    </div>
    <ul>
      <a href="send_money.php">SEND</a>
      <a href="deposit.php">DEPOSIT</a>
      <a href="">TRANSACTIONS</a>
      <a href="profile.php">PROFILE</a>
    </ul>
</nav>
