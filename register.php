<?php
require_once 'constants/conn.php';
session_start();

//variable
$msg = "";
$msgtype = "";
$fullname = "";
$username = "";
$profile_image = "";
$phone = "";
$email = "";
$password = "";

// register system codes
if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $profile_image = $_POST['profile_image'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $balance = $_POST['balance'];
    $date = $_POST['date'];
    $randomNum = random_bytes(10);



    $sqli = "SELECT * FROM users WHERE email = ?";
    $prepare = $conn->prepare($sqli);
    $prepare->bind_param("s", $email);
    $prepare->execute();
    $output = $prepare->get_result();
    $result = $output->num_rows;

   if($result == 0){
      
        if(!empty($fullname AND $username AND $profile_image AND $phone AND $email AND $password)){
      
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $mysql = "INSERT INTO users(account_number,fullname,username,profile_image,email,phone,password,balance,date) VALUES(?,?,?,?,?,?,?,?,?)";
               $prepare = $conn->prepare($mysql);
               $prepare->bind_param("sssssssss", $randomNum,$fullname, $username, $profile_image, $email, $phone, $hashed_password, $balance, $date);
               $prepare->execute(); 

               if($prepare){
                   header("location: dashboard/index.php");
               }

           }else{
               $msg = "Please make sure none of the inputs is empty";
               $msgtype = "danger";
           }

   }else{
       $msg = "Email already Exist";
       $msgtype = "danger";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 100px">
        <div class="row">
    <div class="col-md-6 offset-3 card p-5">
        <div class="container-fluid text-center p-4">
            <h4 class="text-primary">Register To Enjoy Free banking services</h4>
        </div>
            <form action="register.php"  method="POST">
                <div class="alert text-center alert-<?php echo $msgtype ?> "> <?php echo $msg ?> </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $fullname ?>" name="fullname" placeholder="Fullname">
                    </div>

                    <div class="form-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $username ?>" name="username" placeholder="Username">
                </div>

                <div class="form-group mb-3">
                    <input type="number" class="form-control" value="<?php echo $phone ?>" name="phone" placeholder="Phone">
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $email ?>" name="email" placeholder="Your Email">

                </div> 

                <div class="form-group mb-3">
                    <input type="file" class="form-control" value="<?php echo $profile_image ?>"  name="profile_image" placeholder="Upload Your image">

                </div> 

                <div class="form-group mb-3">
                    <input type="password" class="form-control" value="<?php echo $password ?>" name="password" placeholder="Password">
                </div>

                <input type="hidden" name="balance" value="00000000">
                <input type="hidden" name="date" value="<?php echo date("Y.m.d: h.m.s") ?>">
                <input type="hidden" name="id" value="<?php echo $id ?>">

                <button class="btn btn-info offset-5 mt-5" name="register">Register</button>
                    <p class="mt-5">Already have account <a class="btn btn-info mt-6" href="login.php">Login</a></p>
            </form>
        </div>
        </div>
    </div>
</body>
</html>