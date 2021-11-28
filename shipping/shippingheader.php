<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .nav-pills a:hover{
        background-color: #ddd;
        color: black;
      }

      .nav-pills{
          font-variant:small-caps;
          font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      }
      
      .main{
        margin-left: 140px;
        font-size: 28px;
        padding: opx 10px;
      }

      @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
      }
</style>

<link href="resources/templatestyles.css" rel="stylesheet">
<link href="resources/bootstrap.min.css" rel="stylesheet">

  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="creststore" viewBox="0 0 118 94">
      <title>CrestStore</title>
      <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
    </symbol>
  </svg>

  <main>
    <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      <div class="container-fluid">
        <a href="../index.php" class="navbar-brand text-white h5">CrestStore
            <svg class="bi me-5" width="40" height="32" role="img" aria-label="CrestStore"><use xlink:href="#creststore"/></svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-pills" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active text-white h5" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white h5" href="#">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white h5" href="#">Fashion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white h5" href="#">Electronics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white h5" href="#">Furniture</a>
            </li>
          </ul>
          <nav class="sb-topnav navbar navbar-expand navbar-dark">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                
            <li class="nav-item">
                <a href="#checkout.php" class="nav-link text-white h5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="icon fa fa-shopping-cart"></i>
                  My Cart
                </a>
            </li>
                <li class="nav-item dropdown" style="margin-left: 30px;">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      <?php if(isset($_SESSION["id"])){ ?>
                      <li><a class="dropdown-item" href="dashboard.php">History</a></li>  
                      <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                      <li><a class="dropdown-item" href="resetpassword.php">Change Password</a></li>
                      <li><hr class="dropdown-divider" /></li>
                      <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                      <?php } else{ ?>
                      <li><a class="dropdown-item" href="signin.php">Login</a></li>
                      <?php } ?>
                    </ul>
                </li>
            </ul>
            </nav>
        </div>
      </div>
    </nav>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Products in Cart</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Your shopping cart is empty
            </div>
            <div class="modal-footer">
              <a href="../index.php"><button type="button" class="btn btn-primary">Continue Shopping</button></a>
              <a href="../checkout.php"><button type="button" class="btn btn-success">Proceed to Checkout</button></a>
            </div>
          </div>
        </div>
      </div>

  </header>
    <!--<div class="b-example-divider"></div>-->
  </main>