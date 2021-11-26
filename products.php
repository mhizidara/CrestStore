<?php
session_start();
$_SESSION['user'] = "naty";
$server_name = "localhost";
$user_name = "root";
$password = "";
$dbs = "online_shop";
$con = mysqli_connect($server_name,$user_name,$password,$dbs) or die("connection failed:".mysqli_connect_error());
if (isset($_SESSION['user'])) {
	# code...
	if($_SERVER["REQUEST_METHOD"] == "POST"){
			if (isset($_FILES['imagess'])) {
				// code...
			

			
	     $file_name = $_FILES['imagess']['name'];
	     $file_tmp = $_FILES['imagess']['tmp_name'];
	     move_uploaded_file($file_tmp,"resource/images/" . $file_name);
	     echo "Stored in" . "resource/images" . $_FILES['imagess']["name"];


   			$name = $_POST['name'];
				$discription = $_POST['discription'];
  		  $price =$_POST['price'];
   			$category = $_POST['category'];
   			$image = $_FILES['imagess']["name"];
    		$quantity = $_POST['quantity'];

    		$sql = "insert into item (name,discription,price,tag,image,username,quantity) values ('".$name."','".$discription."','".$price."','".$category."','".$image."','".$_SESSION['user']."', '".$quantity."')";
    		mysqli_query($con,$sql) or die("unable to execute insert".mysqli_error($con));


    // $va = $this->db->additem($name,$discription,$price,$category,$image);
      //      			header("location:./view/additem2.php? user=".$nm);

    	}
    	elseif (isset($_POST['dele'])) {
    		// code...
    		$itemid = $_POST['itemid'];
    		$sql = "delete from `item` where itemid=$itemid";
          mysqli_query($con, $sql) or die('cant delete');
    	}
   					
	}
?>
<!DOCTYPE html>
	<html>
		<head>
				<title>Add Items</title>
				<meta charset="utf-8">
				<meta name="viewopoint" content="width=device-width,initial-scale=1">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</script>

				<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}


</style>	
		</head>
			<body>
			<div class="header bg-dark">
  <h1 class="h1 text-light">CrestStore</h1><br><br>
</div>
						<div class="jumbotron bg-secondary" style="margin-top: 30px; margin-right:30px; margin-left:30px; ">
						<form action="" method="post" enctype="multipart/form-data">
									<div class="row row-space">
										<div class="col-2 ">
											<div class="input-group">
														<label class="label" style="color: black;">Item Name:</label><br>
														<input  class="input" type="text" name="name" required><br>
											</div>		
										</div>
										<div class="col-2">
											<div class="input-group">
														<label class="label" style="color: black;">Price</label><input class="input" type="float" name="price" required><br>
											</div>		
										</div>
										<div class="col-2">
											<div class="input-group">
														<label class="label" style="color: black;">Discription</label><input  class="input" type="text" name="discription" required><br>
											</div>		
										</div>
										<div class="col-2">
											<div class="input-group">
														<label class="label" style="color: black;" >Quantity</label><input  class="input" type="number" name="quantity" required><br>
											</div>		
										</div>
										<div class="col-2">
											<div class="input-group">
													<label class="label" style="color: black;">	Image</label>
													<input  class="input" type="file" name="imagess" id="imagess" required><br>
											</div>		
										</div>
										<div class="col-2">
											<div class="input-group">
														
													<label class="label" style="color: black;">	catagory </label>
														<select name="category" >

															<option value="Vehicle">Vehicle</option>
															<option value="Electronics">Electronics</option>
															<option value="Apparel">Apparel</option>
														</select><br>
												</div>		
										</div>
										
										<div class="p-t-15">
										
													<input class="button btn-primary" type="submit" name="" value="Add">

										</div>			
											
									</div>
								</form>
						</div>
						
						
						
						
			<table class="table table-light table-border">	
				  <thead>
				<th>id</th>
				<th>Image</th>
				<th>Item Name</th>
				<th>Discription</th>
				<th>Price</th>
				
				
			</thead>	
				<?php
  			
  					


  		
  		
			$sql = "select * from item where username = '".$_SESSION['user']."'";
			$result = mysqli_query($con,$sql)or die('unable to connect'.mysqli_error($con));
	         if (mysqli_num_rows($result) > 0){
	         	while ($row = mysqli_fetch_assoc($result)){
	         		?>
	
    
				
			<tbody>
				<tr>
			<td><?php echo $row['itemid']; ?></td>
			<td><div ><?php echo "<img style=' width: 100px; height: 100px;' src='resource/images/".$row['image']."'>"; ?></div></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['discription']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td><?php echo $row['tag'] ;?></td>
			<form action="" method="post">
			<td><input type="submit" name="" value="delete"> </td>
			<input type="hidden" name="itemid" value="<?php echo $row['itemid']; ?>">
			<input type="hidden" name="id" value="<?php echo $row['itemid']; ?>">
			<input type="hidden" name="dele" value= 1 >
			</form>
				
				
		</tr>

  			<?php }}?>
			</tbody>
</table>
<div class="footer bg-dark">
<footer><p>Copyright (c) 2020 CrestStore.com. All rights reservved</p></footer>

</div>

</body>
</html>
<?php
}
else
header("location:login.php");?>