<?php 

require 'header.php';
require '../dynamics/dynamism.php';

?>

    <style>
        .conn{
    position: relative;
    width: 50rem;
    height: 90vh;
    border: 2px solid #00bfff;
    background: transparent;
    border-radius: 1rem;
    padding: 2rem;
    margin: auto;
}

.hero_conn{
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    width: 90%;
    height: 95%;
    border-radius: 1rem;
    background-color: #00bfff;
    margin: auto;
}
img{
    width: 10rem;
    aspect-ratio: 1/1;
    box-shadow: inset 2px 3px 2px rgb(0,0,0,0.5);
   border-radius: 50%;
   border: 2px solid #ffffff;
   object-fit: cover;

}

.anchor{
    position: absolute;
    bottom: 6%;
    right: 2%;
}
a{
    text-decoration: none;
    font-size: 1rem;
    color: deeppink;
    font-weight: bold;
}
a:hover{
    font-size: 1.1rem;
}
    </style>
</head>
<body>

<div class="conn col-md-5 card">

<?php 

$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$output = $stmt->get_result();

while($dbRow = $output->fetch_assoc()):

?>
    <div class="hero_conn">
        <div class="img_container">
            <img src="..uploads/<?php echo $dbRow['profile_image'] ?>" alt="profile image">
        </div>
        <h2><?php echo $dbRow['username'] ?> </h2>
        <h2><?php echo $dbRow['email'] ?> </h2>
        <div class="anchor">
            <a href="../logout.php">LOGOUT</a>
        </div>
    </div>
<?php endwhile; ?>

</div>

</body>
</html>