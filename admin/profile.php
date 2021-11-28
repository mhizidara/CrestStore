<?php
session_start();
require_once "../resources/config.php";

/*if (strlen($_SESSION['id'] == 0)) {
  header('location:logout.php');
  }*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Administrator Profile | CrestStore</title>

        <link href="../resources/bootstrap4.5.2.min.css" rel="stylesheet" >
        <link href="../resources/bootstrap.min.css" rel="stylesheet">
        <link href="../resources/templatestyles.css" rel="stylesheet">
        <link href="../resources/style.css" rel="stylesheet" />
        <script src="../resources/all.min.js" crossorigin="anonymous"></script>

        <?php require 'header.php'; ?>

    </head>
    
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
        $param_userid = 4; // $_SESSION['id'];
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Store result
            $stmt->store_result();
            
            if($stmt->num_rows == 1){                    
                // Bind result variables
                $stmt->bind_result($fullname, $phonenum, $emailadd, $regdate);
                while ($stmt->fetch()){ ?>

                    <h1 class="mt-4">My Administrator Profile</h1>
                        <div class="card mb-4">
                     
                            <div class="card-body">
                                <a href="edit-profile.php">Edit</a>
                                <table class="table table-bordered">
                                   <tr>
                                    <th>Full Name</th>
                                       <td colspan="3"><?php echo $fullname;?></td>
                                   </tr>
                                   <tr>
                                       <th>Contact No.</th>
                                       <td colspan="3"><?php echo $phonenum;?></td>
                                   </tr>
                                   <tr>
                                       <th>Email Address</th>
                                       <td colspan="3"><?php echo $emailadd;?></td>
                                   </tr>
                                   <tr>
                                       <th>Reg. Date</th>
                                       <td colspan="3"><?php echo $regdate;?></td>
                                   </tr>
                                    </tbody>
                                </table>
                            </div>
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

        <?php require '../users/footer.php'; ?>
        
        <script src="../resources/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="../resources/bootstrap.min.js"></script>
    </body>
</html>