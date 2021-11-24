<?php 
//start the session
session_start();

if(isset($_GET['ship'])){
    $_SESSION['shipping']= $_GET["personal"];
    if($_GET["personal"]=="self"){
        $_SESSION['place']=$_GET['address'];
    } else{
        $_SESSION['place']=$_GET['location'];
    }
    header("location: ./payment.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="../resources/bootstrap4.5.2.min.css" rel="stylesheet" >
    <link href="../resources/bootstrap.min.css" rel="stylesheet" >
    <link href="../resources/templatestyles.css" rel="stylesheet">


    <link rel="stylesheet" href="../resources/shipstyle.css">

    <?php require '../users/header.php'; ?>
    <title>shipping</title>
</head>
<body>
    <main>
        <h2>Checkout</h2>

        <section class="delivery">
            <form action="shipping.php" method="get">
                <div class="personal">
                    <input type="radio" name="personal" id="rad" value="self">
                    <h3>Deliver to me</h3>
                    <input type="text" name="address" id="address" placeholder="Enter your address">
                </div>
                <div class="pickup">
                    <input type="radio" name="personal" id="rad" value="place">
                    <h3>Pickup from store</h3>
                    <h4>select your region</h4>
                    
                    <select name="location" id="location">
                        <option value="Abia">Abia</option>
                        <option value="Akwa-ibom">Akwa-ibom</option>
                        <option value="Ibadan">Ibadan</option>
                        <option value="Abuja">Abuja</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Port-Harcourt">Port-Harcourt</option>
                        <option value="Kano">Kano</option>
                    </select>

                </div>
                <div><a href="./payment.php" target="_blank"><button type="submit" name="ship" class="subbtn">Proceed</button></a></div>
            </form>

        </section>
        <section class="review">

        </section>
    </main>
</body>
</html>