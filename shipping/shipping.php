<?php 
    //start the session
    session_start();
    //store the user data in session or cookie variables
    if(isset($_GET['ship'])){

        $_SESSION['firstname']=$_GET['firstname'];
        $_SESSION['lastname']=$_GET['lastname'];
        $_SESSION['email']=$_GET['email'];
        $_SESSION['address']=$_GET['address'];
        $_SESSION['city']=$_GET['city'];
        $_SESSION['location']=$_GET['location'];

        
        //go to the payment page
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
        <div class="shipping">
            <form action="shipping.php" method="get">
                <div class="row">
                    <div class="col-50">
                        <h3>Billing Address</h3>
                        <label for="fname"><i class="fa fa-user"></i> Firstname</label>
                        <input type="text" id="fname" name="firstname" placeholder="Firstname">
                        <label for="fname"><i class="fa fa-user"></i> Lastname</label>
                        <input type="text" id="lname" name="lastname" placeholder="Lastname">
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter your email">
                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" name="address" placeholder="Enter your address">
                        <label for="city"><i class="fa fa-institution"></i> City</label>
                        <input type="text" id="city" name="city" placeholder="Town">

                        <div class="row">
                            <div class="col-50">
                                <label for="location">Select your region</label>
                                                            
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
                            <div class="col-50">
                                <label for="zip">Zip</label>
                                <input type="text" id="zip" name="zip" placeholder="optional">
                            </div>
                        </div>
                    </div>
                </div>
                <label>
                    <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                </label>
                <button type="submit" name="ship" class="subbtn">To payment</button>
            </form>
            
        </div>

        <section class="review">
            <!-- review your order here-->

            
    
        </section>
    </main>

    
</body>
</html>