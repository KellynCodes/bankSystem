
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Balance</title>
    <link rel="stylesheet" href="../CSS_FILES/style.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body>

<?php

session_start();
require_once '../constants/conn.php';
$user_id = $_SESSION['id'];

$database = "SELECT * FROM users WHERE id = ?";
$querry = $conn->prepare($database) or die(mysqli_error($conn));
$querry->bind_param("s", $user_id);
$querry->execute();
$result = $querry->get_result();
$output = $result->num_rows;

while($row = $result->fetch_array()):
$id = $row['id'];
$fullname = $row['fullname'];
$balance = $row['balance'];

?>  

<div class="container">
    <div class="row">
        <div class="col-lg-8 p-5 card">
           <div class="form-group mb-3">
           <h3>ACC Name<h3>
            <div class="display"> <?php echo $fullname ?> </div>
           </div>

           <div class="form-group mb-3">
           <h3>Available Balance</h3>
            <div class="display " > <?php echo $balance ?> </div>

           </div>

         <div class="form-group mb-3">
         <h3>Date</h3>
            <div class="display"> <?php ?> </div>
         </div>
        </div>
    </div>
</div>

<?php endwhile ?>

    
</body>
</html>