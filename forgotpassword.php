<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$emailaddress = "";
$emailaddress_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["emailaddress"]))){
        $emailaddress_err = "Please enter your email address.";     
    }
    else{
        $emailaddress = trim($_POST["emailaddress"]);
    }
    
    // Check input errors before updating the database
    if(empty($emailaddress_err)) {
        // Prepare an update statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $param_email);
            
            // Set parameters
            $param_email = trim($_POST["emailaddress"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                // Email Address found, redirect to set new password page
                if($stmt->num_rows == 1){
                    $stmt->bind_result($id);
                    $stmt->fetch();
                    
                    //session_regenerate_id();

                    $_SESSION['id'] = $id;
                    header("location: setnewpassword.php");
                }
                else{
                    $emailaddress_err = "User does not exist";
                }
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Reset Password</title>
    <link href="resources/bootstrap4.5.2.min.css" rel="stylesheet" >
    <link href="resources/bootstrap.min.css" rel="stylesheet" >

    <?php require 'header.php'; ?>
</head>
<body>
    <div class="form-signin">
        <h2 style="margin-bottom:50px">Validate Email To Change Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="emailaddress" class="form-control <?php echo (!empty($emailaddress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailaddress; ?>">
                <span class="invalid-feedback"><?php echo $emailaddress_err; ?></span>
            </div>
            <div class="form-group" style="margin-top:30px">
                <input type="submit" class="btn btn-primary" value="Reset Password">
                <a class="btn btn-link ml-2" href="signin.php">Return to login</a>
            </div>
        </form>
    </div>
    
    <?php require 'footer.php'; ?>

    <script src="resources/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="resources/bootstrap.min.js"></script>
    
</body>
</html>