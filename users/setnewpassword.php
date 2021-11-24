<?php
// Initialize the session
session_start();

// Include config file
require_once "../resources/config.php";

// Define variables and initialize with empty values
$password = $confirm_password = "";
$password_err = $confirm_password_err = $setpassword_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the new password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords do not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('si', $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

                // delete cookies by setting the expiration date to one hour ago
                setcookie("username", "", time() - 7200);
                setcookie("password", "", time() - 7200);

                // Redirect to login page
                session_destroy();
                header("location: signin.php");
                exit();
            } else{
                $setpassword_err = "Oops! Something went wrong. Please try again later.";
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
        <title>New Password</title>

        <link href="../resources/bootstrap4.5.2.min.css" rel="stylesheet" >
        <link href="../resources/bootstrap.min.css" rel="stylesheet" >
        <link href="../resources/templatestyles.css" rel="stylesheet">

        <?php require 'header.php'; ?>
    </head>

    <body>
        <div class="container" style="width:400px">
            <h2><p class="text-center">Set New Password</p></h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <?php 
                    if(!empty($setpassword_err)){
                        echo '<div class="alert alert-danger">' . $setpassword_err . '</div>';
                    }
                ?>
                
                    <div class="form-group">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group" style="margin-top:30px">
                        <input type="submit" class="btn btn-primary btn-lg" value="Set New Password" style="margin-top: 20px"/>
                    </div>
                    <p><a href="signin.php">Back to Login</a></p>
                </form>
        </div>

        <?php require 'footer.php'; ?>

        <script src="resources/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="resources/bootstrap.min.js"></script>
        
    </body>
</html>