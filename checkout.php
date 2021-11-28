<?php
// Include config file
require_once "resources/config.php";

// Define variables and initialize with empty values
$fullname = $username = $phonenum = $emailaddress = $password = $confirm_password = "";
$fullname_err = $username_err = $phonenum_err = $emailaddress_err = $password_err = $confirm_password_err = $signup_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate full name
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Your legal name is required.";     
    } 
    elseif(!preg_match("/^([a-zA-Z' ]+)$/",$fullname)){
        echo 'Invalid name given.';
    }
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE fullname = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $param_fullname);
            
            // Set parameters
            $param_fullname = ucwords(trim($_POST["fullname"]));
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $fullname_err = "This user already exists.";
                } else{
                    $fullname = $param_fullname;
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $param_username);
            
            // Set parameters
            $param_username = ucwords(trim($_POST["username"]));
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = $param_username;
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }

    // Validate emailAddress
    if(empty(trim($_POST["emailaddress"]))){
        $emailaddress_err = "Please enter a valid email address.";     
    } else{
        $emailaddress = trim($_POST["emailaddress"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords do not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($fullname_err) && empty($username_err) && empty($phonenum_err) && empty($emailaddress_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (fullname, username, phonenum, email, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('ssss', $param_fullname, $param_username, $param_phonenum, $param_emailaddress, $param_password);
            
            // Set parameters
            $param_fullname = $fullname;
            $param_username = $username;
            $param_phonenum = $phonenum;
            $param_emailaddress = $emailaddress;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: signin.php");
            } else{
                $signup_err = "Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout Details</title>
        
        <link href="resources/bootstrap4.5.2.min.css" rel="stylesheet" >
        <link href="resources/bootstrap.min.css" rel="stylesheet" >
        <link href="resources/templatestyles.css" rel="stylesheet">
        <link href="resources/style.css" rel="stylesheet" />
        <script src="resources/all.min.js" crossorigin="anonymous"></script>

        <?php require 'checkoutheader.php'; ?>

        <style>
            .container {
                max-width: 960px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <main>
                <h2><p class="text-center" style="margin-top: 100px;">Checkout Details</p></h2>

                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your cart</span>
                            <span class="badge bg-primary rounded-pill">3</span>
                        </h4>
        
                        <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                            <h6 class="my-0">Corporate Ash Pants</h6>
                            <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">#12000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                            <h6 class="my-0">Bkue High-waist Female Jean</h6>
                            <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">#8000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                            <h6 class="my-0">Sneakers</h6>
                            <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">#9000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">−#1500</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (NGN)</span>
                            <strong>#27,500</strong>
                        </li>
                        </ul>

                        <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                        </form>
                    </div>

                <div class="col-md-7 col-lg-8">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" novalidate>

                <div class="row g-3">
                <?php 
                    if(!empty($checkout_err)){
                        echo '<div class="alert alert-danger">' . $checkout_err . '</div>';
                    }
                ?>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your billing/shipping address.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="col-md-4">
                        <label for="phonenum" class="form-label">Contact No.</label>
                        <input type="text" class="form-control <?php echo (!empty($phonenum)) ? 'is-invalid' : ''; ?>" value="<?php echo $phonenum; ?>" name="phonenum" required>
                        <div class="invalid-feedback">
                            Please enter your contact phone number.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>Lagos</option>
                        <option>Ogun</option>
                        <option>Rivers</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                </div>

                <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button type="submit" class="btn btn-primary btn-lg">Continue to Checkout</button>

                </form>
                </div>
                </div>
            </main>
        </div>

        <?php require 'footer.php'; ?>

        <script src="resources/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="resources/bootstrap.min.js"></script>
        <script src="resources/form-validation.js"></script>
    </body>
</html>