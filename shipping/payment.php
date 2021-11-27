<?php
//start session
session_start();

if (isset($_POST['pay'])) {
    $_SESSION['method']=$_POST['payment'];

    header("location: ./proceed.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="../resources/bootstrap4.5.2.min.css" rel="stylesheet">
    <link href="../resources/bootstrap.min.css" rel="stylesheet">
    <link href="../resources/templatestyles.css" rel="stylesheet">


    <link rel="stylesheet" href="../resources/shipstyle.css">

    <?php require '../users/header.php'; ?>
    <title>payment</title>
</head>

<body>
    <main>

        <form action="" method="post">
            <div class="container">
                <div class="row">

                    <div class="col-50">
                        <h3>Payment</h3>


                        <div class="h">
                            <input type="radio" name="payment" id="Dcard" value="cards">
                            <label for="Dcard">
                                <h4>Debit cards</h4>
                            </label>
                        </div>

                        <div class="cards">
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="cardname" placeholder="Enter the name on your card">
                            <label for="ccnum">Card number</label>
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                            <label for="expmonth">Exp Month</label>
                            <input type="text" id="expmonth" name="expmonth" placeholder="September">

                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Exp Year</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2018">
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="container " id="on-deli">
                <input type="radio" name="payment" id="irad" value="on-delivery">
                <label for="irad">
                    <h4>Click here to pay on delivery</h4>
                </label>
            </div>
            <div class="container gift-c">
                <div class="v">
                    <input type="radio" name="payment" id="rad" value="gift-card">
                    <label for="rad"><i class="fa fa-user"></i>
                        <h4>Voucher/ Gift Card</h4>
                    </label>
                </div>
                <input type="number" name="voucher" id="gift-c" minlength="16" maxlength="16" placeholder="1111-2222-3333-4444" <?php if($_POST['payment']=="gift-card" &&  empty($_POST['voucher'])) { echo "required";} ?>>


            </div>
            <div class="row2">
                <a href="./proceed.php"><button type="submit" name="pay" class="subbtn">Proceed</button></a>
            </div>

        </form>



    </main>
</body>

</html>