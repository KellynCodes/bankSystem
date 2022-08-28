<?php require 'header.php';

if(!isset($_SESSION['email'])){
    header("location: ../login.php");
}else{

    $id = $_SESSION['id'];

}
?>
    <div class="fullpage">
       <div class="hero">
        <h3>Welcome To <span> FRICOL </span> Web banking</h3>
        <p>WE offer unlimited banking services.</p>
       </div>
    </div>

    <?php require 'footer.php';