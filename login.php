<?php
    session_start();
    require_once 'constants/conn.php';

//LOGIN SYSTEM
$email = "";
$password = "";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbcheck = "SELECT * FROM  users WHERE email = ?";
    $prepareStmt = $conn->prepare($dbcheck);
    $prepareStmt->bind_param("s", $email);
    $prepareStmt->execute();
    $result = $prepareStmt->get_result();
    $output = $result->num_rows;

    if ($output == 1) {

        while ($row = $result->fetch_assoc()) {
          if(!$password == ""){
            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['account_number'] = $row['account_number'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['profile_image'] = $row['profile_image'];
                header("location: dashboard/index.php");

            } else {
                $msg = "Your password is Incorrect";
                $msgtype = "danger";
            }
          }else{
            $msg = "Password Required";
            $msgtype = "danger";
          }
        }
    } else {
        $msg = "User not found Check your email if it is incorrect";
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
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 100px">
        <div class="row">
    <div class="col-md-6 offset-3 card p-5">
        <div class="container-fluid text-center p-4">
            <h4 class="text-primary">Your can Login From Here</h4>
        </div>
            <form action="login.php"  method="POST">
                <div class="alert text-center alert-<?php echo $msgtype ?> "> <?php echo $msg ?> </div>
        
                <div class="form-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $email ?>" name="email" placeholder="Your Email Or Username">

                </div> 

                <div class="form-group mb-3">
                    <input type="password" class="form-control" value="<?php echo $password ?>" name="password" placeholder="Password">
                </div>

                <button class="btn btn-info offset-5 mt-5" name="login">LOGIN</button>
                <p class="mt-5">Already Have An Account</p>
                <a href="register.php" class="btn btn-info mt-2">Register</a>

            </form>
        </div>
        </div>
    </div>
</body>
</html>