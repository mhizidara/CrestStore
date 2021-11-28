<?php
session_start();
require_once "resources/config.php";

if (strlen($_SESSION['id'] == 0)) {
  header('location: logout.php');
  }

//Code for Update
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']))
{
    // Bad redundancy
    $sqlselect = "SELECT fullname, phonenum, email, created_at FROM users WHERE id = ?";
    
    if($stmtselect = $mysqli->prepare($sqlselect)){
        // Bind variables to the prepared statement as parameters
        $stmtselect->bind_param('i', $param_userid);
        
        // Set parameters
        $param_userid = $_SESSION['id'];
        
        // Attempt to execute the prepared statement
        if($stmtselect->execute()){
            // Store result
            $stmtselect->store_result();
            
            if($stmtselect->num_rows == 1){                    
                
                // Bind result variables
                $stmtselect->bind_result($fullname, $phonenum, $emailadd, $regdate);
                
                while ($stmtselect->fetch()){
                    
                    if($fullname == $_POST['fullname'] && $phonenum == $_POST['phonenum'] && $emailadd == $_POST['emailadd']){
                        echo "<script>alert('No data change detected, update cancelled.');</script>";
                        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                    } else{
                        // Prepare an Update statement
                        $sqlupdate = "UPDATE users SET fullname = ?, phonenum = ?, email = ? WHERE id = ?";

                        if($stmtupdate = $mysqli->prepare($sqlupdate)){
                            // Bind variables to the prepared statement as parameters
                            $stmtupdate->bind_param('sssi', $param_fullname, $param_phonenum, $param_emailadd, $param_userID);

                            // Set parameters
                            $param_fullname = $_POST['fullname'];
                            $param_phonenum = $_POST['phonenum'];
                            $param_emailadd = $_POST['emailadd'];
                            $param_userID = $_SESSION['id'];

                            // Attempt to execute the prepared statement
                            if($stmtupdate->execute()){
                                echo "<script>alert('Profile updated successfully');</script>";
                                echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
                            } else{
                                echo "<script>alert('Update failed, please try again.');</script>";
                            }
                            // Close statement
                            $stmtupdate->close();
                        }
                    }
                }
            }
        }
        // Close statement
        $stmtselect->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Profile | CrestStore</title>

        <link href="resources/bootstrap4.5.2.min.css" rel="stylesheet" >
        <link href="resources/bootstrap.min.css" rel="stylesheet">
        <link href="resources/templatestyles.css" rel="stylesheet">
        <link href="resources/style.css" rel="stylesheet" />
        <script src="resources/all.min.js" crossorigin="anonymous"></script>

        <?php require 'header.php'; ?>

    </head>
    <body class="sb-nav-fixed">
    <body class="sb-nav-fixed">
        <main>
            <div class="container-md px-4">            

<?php
// Prepare a select statement
    $sql = "SELECT fullname, phonenum, email, created_at FROM users WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param('i', $param_userid);
        
        // Set parameters
        $param_userid = $_SESSION['id'];
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Store result
            $stmt->store_result();
            
            if($stmt->num_rows == 1){                    
                // Bind result variables
                $stmt->bind_result($fullname, $phonenum, $emailadd, $regdate);
                while ($stmt->fetch()){ ?>

                    <h1 class="mt-4">Edit Profile</h1>
                        <div class="card mb-4">
                        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
                     
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Full Name</th>
                                            <td colspan="3"><input class="form-control" id="fullname" name="fullname" type="text" value="<?php echo $fullname;?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Contact No.</th>
                                            <td colspan="3"><input class="form-control" id="phonenum" name="phonenum" type="text" value="<?php echo $phonenum;?>" pattern="[0-9]{11}" title="11 numeric characters only"  maxlength="11" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
                                            <td colspan="3"><input class="form-control" id="emailadd" name="emailadd" type="email" value="<?php echo $emailadd;?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Reg. Date</th>
                                            <td colspan="3"><?php echo $regdate;?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="6"><input type="submit" class="btn btn-primary btn-lg" name="update" value="Update" style="margin-right: 100px;" />
                                                <a href="profile.php"><input type="button" class="btn btn-secondary btn-lg" name="return" value="Return"/></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        </div>
                    <?php
                }
            } 
        // Close statement
        $stmt->close();
    }
}
// Close connection
$mysqli->close();
?>

            </div>
        </main>
  
        <?php require 'footer.php'; ?>

        <script src="resources/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="resources/bootstrap.min.js"></script>
    </body>
</html>
