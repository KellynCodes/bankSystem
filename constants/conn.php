<?php

require 'db_conn.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));
$msg = "";
$msgtype = "";