<?php
// Initialize the session
session_start(); 
error_reporting(0);
include('resources/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		
		}else{
			$message="Product ID is invalid";
		}
	}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	  <meta name="robots" content="all">
    <title>CrestStore Home Page</title>

    <link href="resources/bootstrap4.5.2.min.css" rel="stylesheet" >
    <link href="resources/bootstrap.min.css" rel="stylesheet" >
    <link href="resources/templatestyles.css" rel="stylesheet">
    <link href="resources/style.css" rel="stylesheet" />
    <script src="resources/all.min.js" crossorigin="anonymous"></script>

    <?php require 'header.php'; ?>
</head>
<body>

<!-- ================= Slider ================= -->
<div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    
	<div class="carousel-inner">
		
		<div class="carousel-item">
			<img src="assets/images/sliders/slider1.png" class="d-block w-100" alt=""/>
			<div class="container">
				<div class="carousel-caption text-start">
					<h1>Get the comfort that you desire for your home</h1>
					<p>Longlasting, durable, affordable and efficient.</p>
					<p><a class="btn btn-lg btn-primary" href="#">See more</a></p>
				</div>
			</div>
		</div>
		
		<div class="carousel-item">
			<img src="assets/images/sliders/slider2.png" class="d-block w-100" alt=""/>
			<div class="container">
				<div class="carousel-caption">
					<h1></h1>
					<p></p>
					<p><a class="btn btn-lg btn-primary" href="#">It's just a click away</a></p>
				</div>
			</div>
		</div>
		
		<div class="carousel-item active">
			<img src="assets/images/sliders/slider3.jpg" class="d-block w-100" alt=""/>
			<div class="container">
				<div class="carousel-caption text-end">
					<h1>PHP Hypertext Preprocessor.</h1>
					<p>A very powerful, robust and elegant programming language which powers more than 50% of websites worldwide.</p>
					<p><a class="btn btn-lg btn-primary" href="product-details.php">Browse gallery of programming books</a></p>
				</div>
			</div>
		</div>
	</div>

    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing" style="margin-top: 50px;">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
		<img src="assets/images/images/vivo-x20.png" class="bd-placeholder-img" width="140" height="140" alt=""/>

        <h2>Vivo X20</h2>
        <p>Experience the power of enhance photography and stunning speed when you purchase the new Vivo X20.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
	  <img src="assets/images/images/Bodycon dress.jpg" class="bd-placeholder-img" width="140" height="140" alt=""/>

        <h2>Slay Queen</h2>
        <p>Turn heads when you walk into the occassion with this amazing body dress with the right curves at the right places.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
	  <img src="assets/images/images/Coporate Ash men's pant.jpg" class="bd-placeholder-img" width="140" height="140" alt=""/>

        <h2>Ash Pants</h2>
        <p>Look good in this corporate pants, suitable for any borad meeting deal signing. Get that confidence that comes with looking good.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Nothing beats like great exercise. <span class="text-muted">All-weather sneakers.</span></h2>
        <p class="lead">Be free from smelly feet and painful ankles, no matter the type of track exercise you embark on.</p>
      </div>
      <div class="col-md-5">
		<img src="assets/images/images/sneakers.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="350" height="350" alt=""/>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Heat things up!<span class="text-muted"> Mesmerizing overlapping dress</span></h2>
        <p class="lead">Make a statement with this indescribably beautiful and stunning gown, fit for whatever occassion.</p>
      </div>
      <div class="col-md-5 order-md-1">
	  <img src="assets/images/images/Overlapping bodycon dress.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="300" height="300" alt=""/>

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Close any deal strong and confident! <span class="text-muted">It's a Checkmate!.</span></h2>
        <p class="lead">Receive a standing ovation at your speech or conclusion of your deliverables.</p>
      </div>
      <div class="col-md-5">
	  <img src="assets/images/images/Fashion men plain blue jean.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="350" height="350" alt=""/>

      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

    <p class="text-center"><a href="products.php"><button type="button" class="btn btn-success btn-lg">All Products</button></a></p>

    <?php require 'footer.php'; ?>

    <script src="resources/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="resources/bootstrap.min.js"></script>
    
</body>
</html>