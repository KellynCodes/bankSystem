<?php
  require 'header.php';
  require_once '../constants/conn.php';

$account_number = "";
$amount = "";
$recepient_account_number = "";

// SEND MONEY/ TRANSFER MONEY CODES
if(isset($_POST['send_money_btn'])){
    $account_number =  $_POST['account_number'];
    $amount =  $_POST['amount'];
    $transaction_label =  $_POST['transaction_label'];
    $id = $_SESSION['id'];
    
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;
    $stmt->close();

    while($sender_row = $result->fetch_assoc()){
        $id = $sender_row['id'];
        $sender_account_number = $sender_row['account_number'];
        $sender_balance = $sender_row['balance'];

        $recepientDb = "SELECT * FROM users WHERE account_number = ?";
        $statement = $conn->prepare($recepientDb);
        $statement->bind_param("s", $account_number);
        $statement->execute();
        $output = $statement->get_result();
        
       while($recepient_row = $output->fetch_assoc()){
        $recepient_account_number = $recepient_row['account_number'];
        $recepient_balance = $recepient_row['balance'];
       }

        if($num == 1){
        if($account_number !== ""){
            if($amount !== ""){
           if($sender_balance > $amount){
            if($account_number == $recepient_account_number){

              $senderDb = "UPDATE users SET balance = ? - ? WHERE account_number = ?";
              $stmt = $conn->prepare($senderDb);
              $stmt->bind_param("sss", $sender_balance, $amount, $sender_account_number);
              $stmt->execute();

                $recepientDb = "UPDATE users SET balance = ? + ? WHERE account_number = ?";
                $statement = $conn->prepare($recepientDb);
                $statement->bind_param("sss", $amount, $recepient_balance, $account_number);
                $statement->execute();


              if($stmt AND $statement){
                $msg = "Transaction successfull, $amount have been debited from you account. Thanks for using FRICOL.";
                $msgtype = "success";
              }

            }else{
                $msg = "Account Number does not exist";
                $msgtype = "danger";
            }
             
              }else{
                $msg = "Your Account Balance is low";
                $msgtype = "secondary";
               }
            }else{
                $msg = "Amount required";
                $msgtype = "danger";
            }
       
          
        }else{
            $msg = "Account number Required";
            $msgtype = "danger";
        }
    }else{
        $msg = "User Does not exist";
        $msgtype = "danger";
       }
         }



}


?>
</head>
<body>
    <div class="container">

        <div class="row">
        <div class="text-center alert alert-<?php echo $msgtype ?>" style="z-index: 0; float: left"> <?php echo $msg ?> </div>
            <div class="col-md-6 offset-3 shadow p-5" style="margin-top: 100px; height: 45rem">
            <div class="container">
                <h3 class="text-center text-info">Transfer Money</h3>
            </div>
         

                <form action="" method="POST">

                <div class="text-center" style="color: deeppink;"><h3>FRICOL BANKING</h3></div>

                    <!-- <input type="number" name="id" class="form-control mb-3"> -->
                    <input type="number" name="account_number" value="<?php echo $account_number; ?>" class="mt-5 mb-3 form-control" placeholder="AC NO: 1234567890">
                    <input type="number" name="amount"value="<?php echo $amount; ?>" class="mb-3 form-control" placeholder="Enter Amount">
                    <input type="text" name="transaction_label" class="form-control mb-5" placeholder="For(optional)..">
                   <input type="hidden" name="sender_account_number" value="<?php echo $sender_account_number; ?><">
                    <a class="btn btn-primary"  href="balance.php">Check Balance</a>

                    <button class="btn btn-primary offset-5" name="send_money_btn">Send</button>
                </form>
            </div>
        </div>
    </div>

    <?php require 'footer.php' ?>