<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // if remember me check box is clicked, values will be stored in $_COOKIE array
                            if(!empty($_POST["remember"])) {
                                //COOKIES for username
                                setcookie ("username",$_POST["username"],time()+ 3600);
                                //COOKIES for password
                                setcookie ("password",$_POST["password"],time()+ 3600);
                            }
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <link href="resources/bootstrap.min.css" rel="stylesheet">
    <link href="resources/templatestyles.css" rel="stylesheet">

    <?php require 'header.php'; ?>
    <style>
        .wrapper{ margin: 20px; }
    </style>
  </head>

  <body>
    
    <div class="form-signin text-center">

        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
        ?>
            
            <div class="form-floating wrapper">
                <input type="text" name="username" placeholder="name@example.com" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
                <label for="username">Username</label>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>

            <div class="form-floating wrapper">
                <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                <label for="password">Password</label>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <div class="form-check wrapper">
                <input class="form-check-input" type="checkbox" name="remember" value="remember">
                <label class="form-check-label" for="remember" style="margin-left: -120px;"> Remember me </label>
            </div>

            <div class="wrapper" style="margin-top:30px">
                <input class="w-100 btn btn-lg btn-primary" type="submit" value="Sign in" />
            </div>
            <p>Forgot Password? <a href="forgotpassword.php">Click here</a></p>
            <p>Don't have an account? <a href="signup.php">Sign up now</a></p>
        </form>
    </div>

    <?php require 'footer.php'; ?>

    <script src="resources/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="resources/bootstrap.min.js"></script>

    </body>
</html>