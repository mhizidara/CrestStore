<?php 
//start session
session_start();

if(isset($_GET['pay'])){
    $_SESSION['paymethod']= $_GET['payment'];  

    header("location: ./proceed.php");

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
    <title>payment</title>
</head>
<body>
    <main>

        <section class="review">

        </section>

        <section class="payment">
            <h3>Payment Options</h3>
            <form action="payment.php" method="get">
                <div class="voucher">
                    <input type="radio" name="payment" id="rad" value="gift-card">
                    <h2>Add a voucher/Gift card</h2>
                    <input type="number" name="voucher" id="gift-c" minlength="16" maxlength="16">
                    
                </div>
                <div class="on-delivery">
                    <input type="radio" name="payment" id="irad" value="on-delivery">
                    <label for="irad"><h2>Click here to pay on delivery</h2></label>
                    
                </div>
                <div class="other">
                    <input type="radio" name="payment" id="rad" value="others">
                    <h2>Other options</h2>
                    <select name="payoptions" id="payoptions">
                        <option value="MasterCard">MasterCard</option>
                        <option value="Paystack">Paystack</option>
                        <option value="Bitcoin">Bitcoin</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                    
                </div>
                <div><a href="./proceed.php"><button type="submit" name="pay" class="subbtn">Proceed</button></a></div>
            </form>
        </section>

    
    
    </main>
</body>
</html>