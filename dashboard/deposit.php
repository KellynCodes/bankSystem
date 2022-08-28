<?php
require 'header.php';

//depost page codes
$account_number = "";
$deposit_amount = "";

if(isset($_POST['deposit'])){
  $acount_number = $_POST['acount_number'];
  $deposit_amount = $_POST['deposit_amount'];

    $user_id = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id = ?";
    $connect = $conn->prepare($sql);
    $connect->bind_param("s", $user_id);
    $connect->execute();
    $output = $connect->get_result();
    $num = $output->num_rows;
    
    if($num == 1){
            
    while($row = $output->fetch_assoc()){
        $id = $row['id'];
        $account_balance = $row['balance'];
        
          if($deposit_amount !== ""){
              $depositdb = "UPDATE users SET balance = ? + ? WHERE id = ?";
                $stmt = $conn->prepare($depositdb);
                $stmt->bind_param("sss", $account_balance, $deposit_amount, $id);
                $stmt->execute();
                
              if($stmt){
              $msg = "$deposit_amount Has been deposited in your account. Thanks for banking with <h3>FRICOL</h3>";
              $msgtype = "success";
             }
        
            }else{
              $msg = "Amount required";
              $msgtype = "danger";
            }
     
        }
    }else{
        $msg = "User does not exist your can login to be able to make deposit";
        $msgtype = "danger";
    }

  
  }

?>

<div class="container">
    <div class="row">
        <div class="col-md-7 shadow offset-3 p-5" style="margin-top: 100px; height: 50rem;">
            <h5 class="text-center text-danger">FRICOL.COM</h5> <i>ENJOY OUR CARSH BACK AFTER DEPOSIT</i>
           <form action="deposit.php" method="post">
    <div class="alert text-center p-3 mt-4 alert-<?php echo $msgtype ?>"><?php echo $msg ?></div>
          
           <input type="hidden" value="<?php echo $account_number ?>" name="acount_number">
           
           <input type="number" class="form-control mb-4" value="<?php echo $deposit_amount ?>" name="deposit_amount" placeholder="DEPOSIT AMOUNT">
            <!-- <input type="text" class="form-control mb-4" name="for"> -->

            <a class="btn btn-primary" style="margin-left: 25rem;" href="balance.php">Check Balance</a>


            <button class="btn btn-info offset-5" name="deposit">DEPOSIT</button>
           </form>
        </div>
    </div>
</div>
    
<?php require 'footer.php' ?>