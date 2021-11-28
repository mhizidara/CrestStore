<?php
session_start();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processing</title>

    <link href="../resources/bootstrap4.5.2.min.css" rel="stylesheet" >
    <link href="../resources/bootstrap.min.css" rel="stylesheet" >
    <link href="../resources/templatestyles.css" rel="stylesheet">
    <link href="../resources/style.css" rel="stylesheet" />
    <script src="../resources/all.min.js" crossorigin="anonymous"></script>

    <?php require 'shippingheader.php'; ?>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <!--<h1 class="my-5">Dear, <b><?php //echo htmlspecialchars($_SESSION["username"]); ?></b>. .</h1>-->

    <p style="margin-top: 150px;"><h1 class="my-5">Dear, <b><?php echo "Guest"; ?></b>. .</h1></p>
    <?php if($_SESSION['method']== "on-delivery"){
        echo "<h2>Your Order is being processed</h2><br> <h3> An invoice will be sent to you shortly </h3>";
    } elseif($_SESSION['method']== "cards"){
        echo "<br> <h3> Please wait while we confirm your payment details. <br>An invoice will be sent to you shortly</h3>";
    } else{
        echo "<br> <h3> Your Gift-card is being validated. An invoice will be sent to you shortly </h3>";
    } ?>
        
        <?php require '../footer.php'; ?>

<script src="../resources/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="../resources/bootstrap.min.js"></script>

</body>
</html>